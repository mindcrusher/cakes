<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.09.2016
 * Time: 8:28
 */

namespace app\controllers;


use app\models\ContactForm;
use app\models\shop\db\Order;
use app\models\shop\db\Customer;
use app\models\shop\db\OrderProducts;
use app\models\shop\form\Customer as CustomerForm;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class OrderController extends Controller
{
    public function actionCheckout()
    {
        /** @var Order $order */
        /** @var Customer $customer */
        /** @var CustomerForm $form */

        $form = new CustomerForm();
        $form->load($_POST);

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $customer = $this->fillCustomer($form);
            if (!$customer->save()) {
                throw new \Exception('Fail to save customer');
            }

            $order = $this->fillOrder($form, $customer);

            if (!$order->save()) {
                throw new \Exception('Fail to save customer');
            }

            foreach (\Yii::$app->cart->getPositions() as $position) {

                if (!$this->fillPosition($order, $position)->save()) {
                    throw new \Exception('Fail to save position');
                }
            }

            \Yii::$app->session->set('orderID', $order->id);
            \Yii::$app->cart->removeAll();

            $contactForm = new ContactForm([
                'email' => $customer->email,
                'name' => $customer->getName(),
                'subject' => 'Новый заказ на сумму: ' . $order->amount(),
                'body' => $this->render('mail_admin_confirm', [
                    'order' => $order
                ])
            ]);

            $contactForm->contact(\Yii::$app->params['adminEmail']);

            $this->redirect(['confirm']);

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw new ServerErrorHttpException($e->getMessage());
        }
    }

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionConfirm()
    {
        $order = Order::findOne(\Yii::$app->session->get('orderID'));

        if (!$order) {
            throw new NotFoundHttpException('Заказ не найден');
        }

        return $this->render('confirm', [
            'order' => $order,
        ]);
    }

    /**
     * @param CustomerForm $form
     * @return Customer
     */
    private function fillCustomer(CustomerForm $form)
    {
        $customer = new Customer($form->mapToModel());
        $customer->creation_date = new Expression('now()');
        $customer->modification_date = new Expression('now()');

        return $customer;
    }

    /**
     * @param CustomerForm $form
     * @param Customer $customer
     * @return Customer
     */
    private function fillOrder(CustomerForm $form, Customer $customer)
    {
        $order = new Order([
            'customer_id' => $customer->id,
            'pickup_date' => $form->pickupDate,
        ]);
        $order->generateID();
        $order->creation_date = new Expression('now()');
        $order->modification_date = new Expression('now()');

        return $order;
    }

    public function fillPosition(Order $order, \app\models\shop\form\Product $position )
    {
        /** @var \app\models\shop\form\Product $position */
        $orderProducts = new OrderProducts();
        $orderProducts->order_id = $order->id;
        $orderProducts->product_id = $position->getId();
        $orderProducts->amount = $position->getQuantity();
        $orderProducts->price = $position->getPrice();
        $orderProducts->creation_date = new Expression('now()');
        $orderProducts->modification_date = new Expression('now()');
        return $orderProducts;
    }
}