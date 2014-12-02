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

    public function getMaxEmotionFaces($emotion) {
        $this->virtualFields['max'] = 0;
        $options = array(
            'conditions' => array('Emotion.my_emotion' => $emotion),
            'fields' => array('Emotion.img_file', 'Emotion.my_emotion', 'Emotion.my_emotion_val as Emotion__max'),
            'order' => array('Emotion.my_emotion_val DESC', 'Emotion.id DESC')
        );
        return $this->find('first', $options);
    }

    public function getHistorical() {
        $options = array(
            'fields' => array('Emotion.record_date', 'Emotion.my_emotion', 'Emotion.my_emotion_val'),
            'order' => array('Emotion.record_date')
        );
        return $this->find('all', $options);
    }
}
