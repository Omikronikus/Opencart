<?php
class ControllerCommonHome extends Controller {

    public function index() {

//        $data['user_token'] = $this->session->data['user_token'];

		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		if (isset($this->request->get['route'])) {
			$this->document->addLink($this->config->get('config_url'), 'canonical');
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

//		Custom code
        $this->load->model('catalog/category');

        $data['sales'] = array();
        $data['sales'] = $this->model_catalog_category->getCategories(62);




		$this->response->setOutput($this->load->view('common/home', $data));
	}

    public function ajaxGetProducts(){

        $this->load->model('catalog/product');

        $json['products'] = array();


        if(isset($this->request->get['category_id'])){
            $category_id = $this->request->get['category_id'];

        }

        $json['products'] = $this->model_catalog_product->getProductsByCategoryId($category_id);

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));

    }
}
