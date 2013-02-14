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

	public function addAction()
	{
	}

	public function editAction()
	{
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