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
}
