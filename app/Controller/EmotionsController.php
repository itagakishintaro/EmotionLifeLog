<?php
App::uses('AppController', 'Controller');
/**
 * Emotions Controller
 *
 * @property Emotion $Emotion
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EmotionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Emotion->recursive = 0;
		$this->set('emotions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Emotion->exists($id)) {
			throw new NotFoundException(__('Invalid emotion'));
		}
		$options = array('conditions' => array('Emotion.' . $this->Emotion->primaryKey => $id));
		$this->set('emotion', $this->Emotion->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
    $this->layout = false;
		if ($this->request->is('post')) {
			$this->Emotion->create();
			if ($this->Emotion->save($this->request->data)) {
				$this->Session->setFlash(__('The emotion has been saved.'));
				return $this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('The emotion could not be saved. Please, try again.'));
			}
		}
	}

	public function getMyEmotion() {
		$this->autoRender = false;
		$jsonData = array();
		$jsonData = $this->Emotion->getSumMyEmotion();
		echo json_encode($jsonData);
	}

	public function getMaxEmotionFaces() {
		$this->autoRender = false;
		$imageData = $this->Emotion->getMaxEmotionFaces();
		echo json_encode($imageData);
	}

	public function getHistorical() {
		$this->autoRender = false;
		$jsonData = $this->Emotion->getHistorical();
		echo json_encode($jsonData);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Emotion->exists($id)) {
			throw new NotFoundException(__('Invalid emotion'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Emotion->save($this->request->data)) {
				$this->Session->setFlash(__('The emotion has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The emotion could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Emotion.' . $this->Emotion->primaryKey => $id));
			$this->request->data = $this->Emotion->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Emotion->id = $id;
		if (!$this->Emotion->exists()) {
			throw new NotFoundException(__('Invalid emotion'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Emotion->delete()) {
			$this->Session->setFlash(__('The emotion has been deleted.'));
		} else {
			$this->Session->setFlash(__('The emotion could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
