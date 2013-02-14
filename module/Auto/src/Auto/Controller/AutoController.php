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
	}

	public function getAutoTable()
	{
		if (!$this->autoTable) {
			$sm = $this->getServiceLocator();
			$this->autoTable = $sm->get('Auto\Model\AutoTable');
		}
		return $this->autoTable;
	}
}