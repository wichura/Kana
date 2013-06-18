
<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property string $Id
 * @property string $DateCreated
 * @property string $Name
 * @property string $ProjectTypeId
 * @property string $ProjectKey
 * @property string $URI
 * @property string $ClientId
 *
 * The followings are the available model relations:
 * @property Client $client
 * @property Cmsuser $creatorCMSUser
 * @property Media $media
 * @property Cmsuser $modifierCMSUser
 * @property Projecttype $projectType
 */
class Project extends MataActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Project the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'project';
    }

    public function defaultScope() {
        return array();
    }

    public function scopes() {
        return array(
            'users' => array(
                'with' => array(
                    "users" => array(
                        "joinType" => "INNER JOIN",
                        "condition" => "UserId = " . Yii::app()->user->getId()
                    )
                )
            )
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ProjectTypeId, ProjectKey, CreatorUserId, ProjectPlace, ModifierUserId, 
                AgeGroupId, SubjectTaughtId, CourseTypeId, CourseLevelId', 'required'),
            array('ProjectTypeId', 'length', 'max' => 2),
            array('ProjectKey', 'length', 'max' => 32),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('Id, DateCreated, Name, ProjectTypeId, ProjectKey, DateModified, CreatorUserId, 
                SubjectTaughtId,NoOfParticipants, CourseTypeId, CourseLevelId, ModifierUserId', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'client' => array(self::BELONGS_TO, 'Client', 'ClientId'),
            'creatorCMSUser' => array(self::BELONGS_TO, 'Cmsuser', 'CreatorUserId'),
            'modifierCMSUser' => array(self::BELONGS_TO, 'Cmsuser', 'ModifierUserId'),
            'projectType' => array(self::BELONGS_TO, 'ProjectType', 'ProjectTypeId'),
            'users' => array(self::MANY_MANY, 'User', 'userproject(UserId, ProjectId)'),
            'subjectTaught' => array(self::BELONGS_TO, 'ProjectSubjectTaught', 'SubjectTaughtId'),
            'courseType' => array(self::BELONGS_TO, 'ProjectCourseType', 'CourseTypeId'),
            'subjectLevel' => array(self::BELONGS_TO, 'ProjectCourseLevel', 'CourseLevelId'),
            'ageGroup' => array(self::BELONGS_TO, 'ProjectAgeGroup', 'AgeGroupId')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'Id' => 'ID',
            'DateCreated' => 'Data utworzenia',
            'Name' => 'Nazwa',
            'ProjectTypeId' => 'Typ Zajęcia',
            'ProjectKey' => 'Project Key',
            "AgeGroupId" => "Grupa Wiekowa",
            "SubjectTaughtId" => "Przedmiot",
            "CourseTypeId" => "Rodzaj Zajęcia",
            "CourseLevelId" => "Poziom",
            'ProjectPlace' => "Miejsce",
            'DateModified' => 'Date Modified',
            'CreatorUserId' => 'Creator Cmsuser',
            'ModifierUserId' => 'Modifier Cmsuser',
            "NoOfParticipants" => "Uczestników"
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('Id', $this->Id, true);
        $criteria->compare('DateCreated', $this->DateCreated, true);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('ProjectTypeId', $this->ProjectTypeId, true);
        $criteria->compare('ProjectKey', $this->ProjectKey, true);
        $criteria->compare('DateModified', $this->DateModified, true);
        $criteria->compare('CreatorUserId', $this->CreatorUserId, true);
        $criteria->compare('ModifierUserId', $this->ModifierUserId, true);

        if (isset($_GET["filter"]) && !empty($_GET["filter"])) {
            $filter = $_GET["filter"];
            $criteria->compare("t.Name", $filter, true, "OR");

            $criteria->with = array(
                "subjectTaught", "projectType", "courseType", "subjectLevel", "ageGroup"
            );

            $criteria->addSearchCondition('subjectTaught.Name', $filter, true, "OR", "LIKE");
            $criteria->addSearchCondition('projectType.Name', $filter, true, "OR", "LIKE");
            $criteria->addSearchCondition('courseType.Name', $filter, true, "OR", "LIKE");
            $criteria->addSearchCondition('subjectLevel.Name', $filter, true, "OR", "LIKE");
            $criteria->addSearchCondition('ageGroup.Name', $filter, true, "OR", "LIKE");
        }

        $criteria->together = true;

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            "sort" => array(
                "defaultOrder" => "t.Name ASC"
            )
        ));
    }

    public function getLabel() {
        return $this->Name;
    }

    public function beforeValidate() {

        if ($this->isNewRecord) {
            $this->ProjectKey = new CDbExpression("REPLACE(UUID(), '-', '')");
            $this->Language = "pl";

            $newId = Project::model()->dbConnection->createCommand("select MAX(Id) + 1 from " . $this->tableName())->queryRow();
            $newId = str_pad(current($newId), 4, "0", STR_PAD_LEFT);

            $this->Name = ProjectType::model()->findByPk($this->ProjectTypeId)->Code . "-" .
                    ProjectCourseType::model()->findByPk($this->CourseTypeId)->Code . "-" .
                    ProjectAgeGroup::model()->findByPk($this->AgeGroupId)->Code . "-" .
                    ProjectSubjectTaught::model()->findByPk($this->SubjectTaughtId)->Code . "-" .
                    ProjectCourseLevel::model()->findByPk($this->CourseLevelId)->Code . "-" .
                    $newId;
        }

        return parent::beforeValidate();
    }

    protected function afterSave() {

        if ($this->isNewRecord) {
            $linking = new UserProject();
            $linking->attributes = array(
                "ProjectId" => $this->Id,
                "UserId" => Yii::app()->user->getId()
            );

            if ($linking->save() == false)
                throw new CHttpException("Could not create the linking between the new project and the user due to: " . $linking->getFirstError());
        }

        parent::afterSave();
    }

    public function getSortableAttributes() {
        return array("Name", "DateCreated", "SubjectTaughtId", "AgeGroupId",
            "CourseTypeId", "CourseLevelId", "ProjectTypeId");
    }

}