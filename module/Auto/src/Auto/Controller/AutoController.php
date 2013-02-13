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
		return new ViewModel(array(
			'hitauto' => $this->getAutoTable()->getHitAuto(),
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