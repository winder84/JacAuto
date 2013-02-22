<?php
/**
 * Created by JetBrains PhpStorm.
 * User: winder
 * Date: 10.02.13
 * Time: 10:40
 * To change this template use File | Settings | File Templates.
 */
namespace Auto\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AutoController extends AbstractActionController
{
	protected $autoTable;

	public function indexAction()
	{
		$category_list = $this->getAutoTable()->getCategoryList();
		foreach($category_list as $key => $category) {
			$cat_list[$key]['title'] = $category->title;
			$cat_list[$key]['link'] = '/list/' . $category->id;
		}
		return new ViewModel(array(
			'hitauto' => $this->getAutoTable()->getHitAuto(),
			'cat_list' => $cat_list,
		));
	}

	public function adminAction($id = null)
	{
		if (!$this->zfcUserAuthentication()->hasIdentity()) {
			return $this->redirect()->toRoute('zfcuser/login');
		}

		$category_list = $this->getAutoTable()->getCategoryList();
		foreach($category_list as $key => $category) {
			$category_all[$key]['title'] = $category->title;
			$category_all[$key]['id'] = $category->id;
			$category_all[$key]['desc'] = $category->description;
			$category_all[$key]['image'] = $category->image;
			$category_all[$key]['ref_id'] = $category->ref_id;
		}

		$products_list = $this->getAutoTable()->getProductsAll();
		foreach($products_list as $key => $product) {
			$products_all[$key]['title'] = $product->title;
			$products_all[$key]['id'] = $product->id;
			$products_all[$key]['desc'] = $product->description;
			$products_all[$key]['firm_id'] = $product->firm_id;
			$products_all[$key]['ref_id'] = $product->ref_id;
			$products_all[$key]['image'] = $product->image;
			$products_all[$key]['is_on_main'] = $product->is_on_main;
		}

		$firms_list = $this->getAutoTable()->getFirmsAll();
		foreach($firms_list as $key => $firms) {
			$firms_all[$key]['title'] = $firms->title;
			$firms_all[$key]['id'] = $firms->id;
			$firms_all[$key]['desc'] = $firms->description;
			$firms_all[$key]['image'] = $firms->image;
		}

		return new ViewModel(array(
			'firms_all' => $firms_all,
			'products_all' => $products_all,
			'category_all' => $category_all,
		));
	}


	public function addAction()
	{
	}

	public function editAction()
	{
		if (!$this->zfcUserAuthentication()->hasIdentity()) {
			return $this->redirect()->toRoute('zfcuser/login');
		}

		if(isset($_POST['cat_edit'])) {
			$id = $_POST['cat_edit'];
			$aCategoryUpd['title'] = $_POST['title'];
			$aCategoryUpd['description'] = $_POST['description'];
			$aCategoryUpd['ref_id'] = $_POST['ref_id'];
			$aCategoryUpd['image'] = $_POST['image'];
			if($this->getAutoTable()->setCategory($id, $aCategoryUpd)) {
				return $this->redirect()->toRoute('/admin');
			}
		}

		if(isset($_POST['cat_id'])) {
			$id = $_POST['cat_id'];
			$category = $this->getAutoTable()->getCategory($id);
			foreach($category as $cat){
			$aCategory['id'] = $cat->id;
			$aCategory['title'] = $cat->title;
			$aCategory['ref_id'] = $cat->ref_id;
			$aCategory['description'] = $cat->description;
			$aCategory['image'] = $cat->image;
			}

			$category_list = $this->getAutoTable()->getCategoryList();
			foreach($category_list as $key => $category) {
				$category_all[$key]['title'] = $category->title;
				$category_all[$key]['id'] = $category->id;
				$category_all[$key]['desc'] = $category->description;
				$category_all[$key]['image'] = $category->image;
				$category_all[$key]['ref_id'] = $category->ref_id;
			}

			return new ViewModel(array(
				'category_all' => $category_all,
				'aCategory' => $aCategory,
			));
		}

		if(isset($_POST['firm_id'])) {
			$id = $_POST['firm_id'];
			$oFirm = $this->getAutoTable()->getFirm($id);
			foreach($oFirm as $firm){
				$aFirm['id'] = $firm->id;
				$aFirm['title'] = $firm->title;
				$aFirm['description'] = $firm->description;
				$aFirm['image'] = $firm->image;
			}

			return new ViewModel(array(
				'aFirm' => $aFirm,
			));
		}

		if(isset($_POST['prod_id'])) {
			$id = $_POST['prod_id'];
			$oProduct = $this->getAutoTable()->getProduct($id);
			foreach($oProduct as $product){
				$aProduct['id'] = $product->id;
				$aProduct['title'] = $product->title;
				$aProduct['description'] = $product->description;
				$aProduct['image'] = $product->image;
				$aProduct['ref_id'] = $product->ref_id;
				$aProduct['firm_id'] = $product->firm_id;
				$aProduct['is_on_main'] = $product->is_on_main;
			}
			$category_list = $this->getAutoTable()->getCategoryList();
			foreach($category_list as $key => $category) {
				$category_all[$key]['title'] = $category->title;
				$category_all[$key]['id'] = $category->id;
				$category_all[$key]['desc'] = $category->description;
				$category_all[$key]['image'] = $category->image;
				$category_all[$key]['ref_id'] = $category->ref_id;
			}
			$firms_list = $this->getAutoTable()->getFirmsAll();
			foreach($firms_list as $key => $firms) {
				$firms_all[$key]['title'] = $firms->title;
				$firms_all[$key]['id'] = $firms->id;
				$firms_all[$key]['desc'] = $firms->description;
				$firms_all[$key]['image'] = $firms->image;
			}

			return new ViewModel(array(
				'aProduct' => $aProduct,
				'category_all' => $category_all,
				'firms_all' => $firms_all,
			));
		}

	}

	public function deleteAction()
	{
	}

	public function catalogAction()
	{
		$category_list = $this->getAutoTable()->getCategoryList();
		foreach($category_list as $key => $category) {
			$category_all[$key]['title'] = $cat_list[$key]['title'] = $category->title;
			$category_all[$key]['link'] = $cat_list[$key]['link'] = '/list/' . $category->id;
			$category_all[$key]['desc'] = $category->description;
			$category_all[$key]['image'] = $category->image;
		}
		return new ViewModel(array(
			'category_all' => $category_all,
			'cat_list' => $cat_list,
		));
	}

	public function listAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);
		$product_list = $this->getAutoTable()->getProductList($id);
		foreach($product_list as $key => $product) {
			$product_all[$key]['title'] = $product->title;
			$product_all[$key]['link'] = '/product/' . $product->id;
			$product_all[$key]['desc'] = $this->crop_str($product->description,800);
			$product_all[$key]['image'] = $product->image;
			$product_all[$key]['firm_id'] = $product->firm_id;
		}

		$category_list = $this->getAutoTable()->getCategoryList();
		foreach($category_list as $key => $category) {
			$category_all[$category->id]['title'] = $cat_list[$key]['title'] = $category->title;
			$category_all[$category->id]['link'] = $cat_list[$key]['link'] = '/list/' . $category->id;
			$category_all[$category->id]['desc'] = $this->crop_str($category->description, 800);
			$category_all[$category->id]['image'] = $category->image;
		}

		return new ViewModel(array(
			'category' => $category_all[$id],
			'product_all' => $product_all,
			'cat_list' => $cat_list,
		));
	}

	public function productAction() {
		$id = (int) $this->params()->fromRoute('id', 0);
		$product = $this->getAutoTable()->getProduct($id);
		foreach($product as $prod){
			$prod_itog = $prod;
		}
		$id = (int)$prod_itog->ref_id;
		$prod_itog->description = $this->crop_str($prod_itog->description, 800);

		$category_list = $this->getAutoTable()->getCategoryList();
		foreach($category_list as $key => $category) {
			$category_all[$category->id]['title'] = $cat_list[$key]['title'] = $category->title;
			$category_all[$category->id]['link'] = $cat_list[$key]['link'] = '/list/' . $category->id;
			$category_all[$category->id]['desc'] = $this->crop_str($category->description, 800);
			$category_all[$category->id]['image'] = $category->image;
		}

		return new ViewModel(array(
			'category' => $category_all[$id],
			'product' => $prod_itog,
			'cat_list' => $cat_list,
		));
	}

	public function getAutoTable()
	{
		if (!$this->autoTable) {
			$sm = $this->getServiceLocator();
			$this->autoTable = $sm->get('Auto\Model\AutoTable');
		}
		return $this->autoTable;
	}

	function crop_str($string, $limit)
	{

		$substring_limited = substr($string,0, $limit);

		return substr($substring_limited, 0, strrpos($substring_limited, ' ' )) . '...';

	}
}