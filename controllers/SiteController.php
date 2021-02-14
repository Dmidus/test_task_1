<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\data\SqlDataProvider;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'only' => ['logout'],
    //             'rules' => [
    //                 [
    //                     'actions' => ['logout'],
    //                     'allow' => true,
    //                     'roles' => ['@'],
    //                 ],
    //             ],
    //         ],
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'logout' => ['post'],
    //             ],
    //         ],
    //     ];
    // }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Upload files.
     *
     * @return string
     */
    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->uploadedFiles = UploadedFile::getInstances($model, 'uploadedFiles');
            if ($model->upload()) {
                // file is uploaded successfully
                Yii::$app->session->setFlash('success', 'Файлы успешно сохранены на сервере');
                return $this->render('upload', ['model' => $model]);
            } else {
                Yii::$app->session->setFlash('error', 'Не удалось сохранить файлы на сервере');
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    public function actionFiles()
    {
        $count = Yii::$app->db->createCommand('select COUNT(*) from files_t;')->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql' => 'SELECT file_name, upload_datetime FROM files_t',
            'totalCount' => $count,
            'sort' => [
                'attributes' => [
                    'upload_datetime' => [
                        'asc' => ['upload_datetime' => SORT_ASC],
                        'desc' => ['upload_datetime' => SORT_DESC],
                        'default' => SORT_ASC,
                    ],
                ],
            ],
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return $this->render('files', ['dataProvider' =>$dataProvider]);
    }
}
