<?php

namespace frontend\controllers;

use app\models\Household;
use app\models\HouseholdMember;
use app\models\HouseholdSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model as YiiModel;
use Yii;
use yii\base\Model;



/**
 * HouseholdController implements the CRUD actions for Household model.
 */
class HouseholdController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Household models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new HouseholdSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Household model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $houseHoldMembers = $model->houseHoldMembers;

        return $this->render('view', [
            'model' => $model,
            'houseHoldMembers' => $houseHoldMembers,
        ]);
    }


    /**
     * Creates a new Household model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if (is_array($this->house_status)) {
                $this->house_status = array_filter($this->house_status);
                $this->house_status = implode(',', $this->house_status);
            }
            return true;
        }
        return false;
    }



    public function afterFind()
    {
        parent::afterFind();
        if (!empty($this->house_status)) {
            $this->house_status = explode(',', $this->house_status);
        } else {
            $this->house_status = [];
        }
    }




    public function actionCreate()
    {
        $model = new Household();

        $houseHoldMembers = [new HouseHoldMember()];

        if ($model->load(Yii::$app->request->post())) {

            $houseHoldMembersPost = Yii::$app->request->post('HouseHoldMember', []);
            $houseHoldMembers = [];

            foreach ($houseHoldMembersPost as $i => $memberData) {
                $member = !empty($memberData['id'])
                    ? HouseHoldMember::findOne($memberData['id'])
                    : new HouseHoldMember();
                $member->attributes = $memberData;
                $houseHoldMembers[] = $member;
            }

            $valid = $model->validate();

            if ($valid) {

                $model->save(false);

                foreach ($houseHoldMembers as $member) {
                    $member->fk_household_id = $model->id;
                    $member->save(false);
                }

                return $this->redirect(['view', 'id' => $model->id]);
            } else {

                Yii::error($model->errors, __METHOD__);
                foreach ($houseHoldMembers as $i => $member) {
                    Yii::error("Member $i errors: " . json_encode($member->errors), __METHOD__);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'houseHoldMembers' => $houseHoldMembers,
        ]);
    }




    /**
     * Updates an existing Household model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Load existing household members
        $houseHoldMembers = $model->houseHoldMembers;
        if (empty($houseHoldMembers)) {
            $houseHoldMembers = [new HouseHoldMember()];
        }

        if ($model->load(Yii::$app->request->post())) {

            // Load POSTed members
            $houseHoldMembersPost = Yii::$app->request->post('HouseHoldMember', []);
            $updatedMembers = [];

            foreach ($houseHoldMembersPost as $i => $memberData) {
                $member = !empty($memberData['id'])
                    ? HouseHoldMember::findOne($memberData['id'])
                    : new HouseHoldMember();
                $member->attributes = $memberData;
                $updatedMembers[] = $member;
            }

            // Validate Household first
            $valid = $model->validate();

            if ($valid) {
                // Save Household
                $model->save(false);

                // Delete removed members
                $existingIds = array_filter(array_column($updatedMembers, 'id'));
                HouseHoldMember::deleteAll([
                    'and',
                    ['fk_household_id' => $model->id],
                    ['not in', 'id', $existingIds]
                ]);

                // Save all updated members
                foreach ($updatedMembers as $member) {
                    $member->fk_household_id = $model->id;
                    $member->save(false);
                }

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::error($model->errors, __METHOD__);
                foreach ($updatedMembers as $i => $member) {
                    Yii::error("Member $i errors: " . json_encode($member->errors), __METHOD__);
                }
            }

            // Assign updated members to variable for rendering form again
            $houseHoldMembers = $updatedMembers;
        }

        return $this->render('update', [
            'model' => $model,
            'houseHoldMembers' => $houseHoldMembers,
        ]);
    }


    /**
     * Deletes an existing Household model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Household model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Household the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Household::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
