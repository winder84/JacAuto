<?php
/**
 * Created by JetBrains PhpStorm.
 * User: winder
 * Date: 10.02.13
 * Time: 11:38
 * To change this template use File | Settings | File Templates.
 */
namespace Auto\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;

class AutoTable
{
	protected $tableGateway;
	protected $adapter;

	public function __construct($dbad)
	{
		$this->adapter = $dbad;
	}

	public function fetchAll()
	{
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$select = $sql->select();
		$select->from('product');

		$selectString = $sql->getSqlStringForSqlObject($select);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function getAuto($id)
	{
		$id  = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}

	public function saveAuto(Auto $auto)
	{
		$data = array(
			'artist' => $auto->artist,
			'title'  => $auto->title,
		);

		$id = (int)$auto->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getAuto($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('Form id does not exist');
			}
		}
	}

	public function getHitAuto() {
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$select = $sql->select();
		$select->from('product');
		$select->where(array('is_on_main' => '1'));

		$selectString = $sql->getSqlStringForSqlObject($select);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function getCategoryList() {
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$select = $sql->select();
		$select->from('category');
		$select->where(array('ref_id' => 0));

		$selectString = $sql->getSqlStringForSqlObject($select);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function getProductList($id) {
		$adapter = $this->adapter;
		$sql = new Sql($adapter);
		$select = $sql->select();
		$select->from('product');
		$select->where(array('ref_id' => $id));

		$selectString = $sql->getSqlStringForSqlObject($select);
		$results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
		return $results;
	}

	public function deleteAuto($id)
	{
		$this->tableGateway->delete(array('id' => $id));
	}
}