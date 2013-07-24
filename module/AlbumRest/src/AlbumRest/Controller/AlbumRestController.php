<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bikashrai
 * Date: 7/18/13
 * Time: 10:15 PM
 * To change this template use File | Settings | File Templates.
 */
namespace AlbumRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;

use AlbumRest\Model\RestTable;
use Album\Form\AlbumForm;
use Album\Model\AlbumTable;
use Zend\View\Model\JsonModel;

class AlbumRestController extends AbstractRestfulController
{
    protected $albumTable;

    public function getList()
    {
        $results = $this->getAlbumTable()->fetchAll();
        $data = array();
        foreach($results as $result) {
            $data[] = $result;
        }
        print_r($data);
        exit;
        return new JsonModel(array('data' => $data));
    }

    public function get($id)
    {
        $album = $this->getAlbumTable()->getAlbum($id);
        return new JsonModel(array("data" => $album));
    }

    public function create($data)
    {
        $form = new AlbumForm();
        $album = new Album();
        $form->setInputFilter($album->getInputFilter());
        $form->setData($data);
        if ($form->isValid()) {
            $album->exchangeArray($form->getData());
            $id = $this->getAlbumTable()->saveAlbum($album);
        }

        return new JsonModel(array(
            'data' => $this->get($id),
        ));
    }

    public function update($id, $data)
    {
        $data['id'] = $id;
        $album = $this->getAlbumTable()->getAlbum($id);
        $form  = new AlbumForm();
        $form->bind($album);
        $form->setInputFilter($album->getInputFilter());
        $form->setData($data);
        if ($form->isValid()) {
            $id = $this->getAlbumTable()->saveAlbum($form->getData());
        }

        return new JsonModel(array(
            'data' => $this->get($id),
        ));
    }

    public function delete($id)
    {
        $this->getAlbumTable()->deleteAlbum($id);

        return new JsonModel(array(
            'data' => 'deleted',
        ));
    }

    public function getAlbumTable()
    {
        if (!$this->albumTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Album\Model\AlbumTable');
        }
        return $this->albumTable;
    }

}