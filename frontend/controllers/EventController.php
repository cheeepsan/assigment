<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Event;
use common\models\EventSearch;
use yii\helpers\Json;
use linslin\yii2\curl;

/**
 * Site controller
 */
class EventController extends Controller
{
	
	private $processed = 0;
	private $totalRecords = 0;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        // $events = Event::find()->all();
        return $this->render('index');
    }

    /**
    * Update and populate data from http://api.espoo.fi/linkedevents/v1/keyword/?format=json
    *
    */
    public function actionData() {
		$this->update();
		
		return $this->redirect(['list']);
    }
	
	private function update() {
		$link = "http://api.espoo.fi/linkedevents/v1/keyword/?format=json";
        $curl = new curl\Curl();
		
        $response = $curl->get($link);

        $json = Json::decode($response);
        $meta = $json['meta'];
        $meta_amount = $meta['count'];
        $meta_next = $meta['next'];

        $data = $json['data'];
		
		$this->totalRecords = $meta_amount;

		
        while ($meta_next != null) {
			$response = $curl->get($meta_next);

			$json = Json::decode($response);
			$meta = $json['meta'];

			$meta_next = $meta['next'];

			$data = $json['data'];
			
			
			foreach ($data as $event) {
	
				$eventModel = null;
				
				$idEventFull = $event['id'];
				$regexMatch = null;
				preg_match('/(?<=\:).*$/', $idEventFull, $regexMatch);
				
				$idEvent = (isset($regexMatch[0]) ? $regexMatch[0] : null); 
				$eventModel = Event::find()->where(['id_event' => $idEvent])->one();
				// var_dump($eventModel); die();
				if ($eventModel == null) {
					$eventModel = new Event();
					$eventModel->id_event_full = $idEventFull;
					$eventModel->id_event = $idEvent;
				}
				
				
				$formatter = \Yii::$app->formatter;
				$formatter->datetimeFormat = 'YYYY-MM-d HH:mm:ss';
				
				$created_time = $event['created_time'];
				if ($created_time != null) {
					$eventModel->created_time = $formatter->asDatetime($created_time);
				} else {
					$eventModel->created_time = null;
				}	
				
				$last_modified_time = $event['last_modified_time'];
				if ($last_modified_time != null) {
					$eventModel->last_modified_time = $formatter->asDatetime($last_modified_time);
					// var_dump($eventModel->last_modified_time); die();
				} else {
					$eventModel->last_modified_time = null;
				}
				
				$eventModel->aggregate = $event['aggregate'];
				$eventModel->data_source = $event['data_source'];
				$eventModel->image = $event['image'];
				
				$eventModel->alt_labels = json_encode($event['alt_labels']);
				
				$nameArr = $event['name'];
				if (isset($nameArr) && !empty($nameArr)) {
					$eventModel->name_fi = (isset($nameArr['fi']) ? $nameArr['fi'] : null);
					$eventModel->name_en = (isset($nameArr['en']) ? $nameArr['en'] : null);
					$eventModel->name_sv = (isset($nameArr['sv']) ? $nameArr['sv'] : null);
				}
				$eventModel->link = $event['@id'];
				$eventModel->context = $event['@context'];
				$eventModel->type = $event['@type'];

				if ($eventModel->save()){

				} else {
					$this->processed = 0;
					return $this->render(['import-error', 'errors' => $eventModel->errors, 'proc' => $processed]);
				}


				$this->processed++;
				// if ($this->processed % 10) {
					// echo Json::encode(['output'=>'ete']);
				// }
			}
			
        }

	}
	public function actionList() {
		$searchModel = new EventSearch();
        $queryParams = Yii::$app->request->queryParams;
        
        $dataProvider = $searchModel->search($queryParams);
		
        return $this->render('list', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
	}
	
	public function actionUpdate($id) {
		$model = Event::find()->where(['id' => $id])->one();
		
		if($model->load(Yii::$app->request->post()) && $model->validate()){
			die();
			if($model->save()) {
				return $this->render('list');
			} else {
				var_dump($model->errors); die();
				return $this->render('update',  ['model' => $model, 'errors' => $model->errors]);
			}
		}
		
		return $this->render('update', ['model' => $model, 'errors' => $model->errors]);
	}

	
	public function actionStatus() {
		// if (Yii::$app->request->isAjax) {
			// $data = Yii::$app->request->post();
			// $this->totalRecords = 644;
			// var_dump($this->totalRecords);
			// \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			// return [
				// 'proc' => $this->processed,
				// 'total' => $this->totalRecords,
			// ];
			// echo Json::encode(['proc'=>$this->processed, 'total'=> $this->totalRecords]);
		// }
	}
}
