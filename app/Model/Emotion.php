<?php
App::uses('AppModel', 'Model');
/**
 * Emotion Model
 *
 */
class Emotion extends AppModel {

    public function getSumMyEmotion() {
        $this->virtualFields['sum'] = 0;
        $options = array(
            'fields' => array('Emotion.my_emotion', 'SUM(Emotion.my_emotion_val) as Emotion__sum'),
            'group' => array('Emotion.my_emotion')
        );
        return $this->find('all', $options);
    }

    public function getMaxEmotionFaces() {
        $this->virtualFields['max'] = 0;
        $options = array(
            'conditions' => array('NOT' => array('Emotion.img_file' => null)),
            'fields' => array('Emotion.img_file', 'Emotion.my_emotion', 'MAX(Emotion.my_emotion_val) as Emotion__max'),
            'group' => array('Emotion.my_emotion')
        );
        return $this->find('all', $options);
    }

    public function getHistorical() {
        $this->virtualFields['max'] = 0;
        $options = array(
            'conditions' => array('NOT' => array('Emotion.img_file' => null)),
            'fields' => array('Emotion.img_file', 'Emotion.my_emotion', 'MAX(Emotion.my_emotion_val) as Emotion__max'),
            'group' => array('Emotion.my_emotion')
        );
        return $this->find('all', $options);
    }
}
