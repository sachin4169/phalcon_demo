<?php

use Phalcon\Mvc\Controller;

class ProductController extends Controller
{

    public function indexAction()
    {
        $this->view->products = Products::find();
    }

    public function addAction()
    {
        $product = new Products();

        $product->assign(
            $this->request->getPost(),
            [
                'p_name',
                'p_price',
            ]
        );

        // Store and check for errors
        $success = $product->save();

        // passing the result to the view
        $this->view->success = $success;

        if ($success) {
            $message = "product add successfuly";
        } else {
            $message = "Sorry, the following problems were generated:<br>"
                    . implode('<br>', $product->getMessages());
        }
        $this->view->message = $message;
        $this->response->redirect('product');
    }

    public function deleteAction()
    {
        $var = $_POST['delete'];
        $products = new Products();
        $product = Products::findFirstByp_id($var);

        $success = $product->delete();

        // passing the result to the view
        $this->view->success = $success;

        if ($success) {
            $message = "product Deleted";
        } else {
            $message = "Sorry, the following problems were generated:<br>"
                . implode('<br>', $product->getMessages());
        }

        // passing a message to the view
        $this->view->message = $message;
        $this->response->redirect("product");
    }

}
