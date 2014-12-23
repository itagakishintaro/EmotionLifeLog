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
			// rekognition apiに写真を送信して感情を取得
			// 参考:http://d.hatena.ne.jp/tboffice/20091027/1256660197
			$ch = curl_init();
			$img_file = $this->request->data["Emotion"]["img_file"];
			$image_array = explode(',', $img_file);
			$opts = array('api_key' => 'k7e9tRIzzHDflSkG', 
              'api_secret' => 'l9lQe9mCjAmSEnEO', 
              'jobs' => 'face_emotion_part',
              'base64' => $image_array[1]);
			curl_setopt($ch, CURLOPT_URL, 'http://rekognition.com/func/api/');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $opts);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$data = curl_exec($ch);
			$data = json_decode($data, true);
			curl_close($ch);

			// 取得した感情の最大値をrequestに設定
			$max = 0; 
			foreach($data["face_detection"][0]["emotion"] as $key => $value){
				if($value > $max){
					$max = $value;
					$maxEmotion = $key;
				}
			}
			$this->request->data["Emotion"]["analyzed_emotion"] 
				= $maxEmotion;
			$this->request->data["Emotion"]["analyzed_emotion_val"] 
				= $data["face_detection"][0]["emotion"][$maxEmotion] * 100;

			// データを保存
			$this->Emotion->create();
			if ($this->Emotion->save($this->request->data)) {
				$this->Session->setFlash(__('The emotion has been saved.'));
				return $this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('The emotion could not be saved. Please, try again.'));
			}
		}
	}

	// Array ( [calm] => 0.83 [confused] => 0.29 [happy] => 0.03 )
	public function getMaxEmotion($emotions){
		$max = 0; 
		foreach($emotions as $key => $value){
			if($value > $max){
				$maxKey = $key;
			}
		}
		return $maxKey;
	}

	public function getMyEmotion() {
		$this->autoRender = false;
		$jsonData = array();
		$jsonData = $this->Emotion->getSumMyEmotion();
		echo json_encode($jsonData);
	}

	public function getMaxEmotionFaces() {
		$this->autoRender = false;
	    $faces = array("happy", "sad", "angry", "fear");
	    foreach ($faces as $v) {
	    	$emotion = $this->Emotion->getMaxEmotionFaces($v);
	    	if( count($emotion) > 0 ){
		        $imageData[] = $emotion;
		    }
	    }
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
