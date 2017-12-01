<?php

namespace myzero1\rbacp\models;

use Yii;
use myzero1\rbacp\models\RbacpPrivilege;
use myzero1\rbacp\models\RbacpPolicy;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "rbacp_role".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $policy_ids
 * @property string $policy_datas
 * @property string $privilege_ids
 * @property integer $status
 * @property integer $created
 * @property integer $updated
 * @property integer $author
 */
class RbacpRole extends RbacpActiveRecord
{
    public $rbacp_privilege_ids;
    public $rbacp_policy_ids;
    public $rbacp_policy_datas;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rbacp_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created', 'updated'], 'required'],
            [['name'], 'unique'],
            [['status', 'created', 'updated', 'author'], 'integer'],
            [['name'], 'string', 'max' => 24],
            [['description'], 'string', 'max' => 24],
            [['policy_ids', 'privilege_ids', 'policy_datas'], 'string', 'max' => 1000],
            [['rbacp_policy_ids', 'rbacp_privilege_ids', 'rbacp_policy_datas'], 'safe'],

            [['name'], '\myzero1\rbacp\components\validators\NoSpecialStrValidator', 'min' => 6, 'max'=>24],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('rbacp', '角色名称'),
            'description' => Yii::t('rbacp', '描述'),
            'policy_ids' => 'Policy Ids',
            'privilege_ids' => 'Privilege Ids',
            'policy_datas' => 'Policy datas',
            'status' => Yii::t('rbacp', '状态'),
            'created' => 'Created',
            'updated' => 'Updated',
            'author' => 'author',
        ];
    }

    /**
     * @inheritdoc
     */
    public function twoD2OneD(array $twoDArray)
    {
        $oneD = array();
        foreach ($twoDArray as $key => $value) {
            $oneD = array_merge($oneD, $value);
        }
        return $oneD;
    }

    /**
     * @inheritdoc
     */
    public function getPrivilegePolicy()
    {
        $aPrivilege = RbacpPrivilege::find()->where(['status' => 1])->orderBy('url')->all();
        $aPolicy = RbacpPolicy::find()->where(['status' => 1, 'scope' => 1])->all();
        $oRole = \myzero1\rbacp\models\RbacpUserView::findOne(Yii::$app->user->id)->role;
        if (is_null($oRole) ) {
            if (\myzero1\rbacp\components\Rbacp::isDeveloper()) {
                # pass
            } else {
                return array();
            }
        } else {
            $aRolePrivilege = explode(',', $oRole->privilege_ids);
            $aRolePlicy = explode(',', $oRole->policy_ids);
        }

        $aPrivilegePolicy = array();
        $aPrivilegeNew = array();
        $aPolicyNew = array();
        foreach ($aPrivilege as $key => $oValue) {
            if (\myzero1\rbacp\components\Rbacp::isDeveloper()) {
                $aPrivilegeNew[$key] = ArrayHelper::toArray($oValue);
            } else if (in_array($oValue->id, $aRolePrivilege) ) {
                $aPrivilegeNew[$key] = ArrayHelper::toArray($oValue);
            } else {
                #code
            }
        }
        $aPolicyClassc = array();
        foreach ($aPolicy as $key => $oValue) {
            if (\myzero1\rbacp\components\Rbacp::isDeveloper()) {
                $aTem = ArrayHelper::toArray($oValue);
                $aPolicyNew[$key] = $aTem;
                $aPolicyClassc[$aPolicyNew[$key]['privilege_id']][] = $aTem;
            } else if (in_array($oValue->id, $aRolePlicy) ) {
                $aTem = ArrayHelper::toArray($oValue);
                $aPolicyNew[$key] = $aTem;
                $aPolicyClassc[$aPolicyNew[$key]['privilege_id']][] = $aTem;
            } else {
                #code
            }
        }
        foreach ($aPrivilegeNew as $key => $value) {
            $aTem = array();
            $aTem['id'] = $value['id'];
            $aTem['name'] = $value['name'];
            $aTem['url'] = $value['url'];
            $policys = array();
            if (isset($aPolicyClassc[$value['id']])) {
                foreach ($aPolicyClassc[$value['id']] as $k => $v) {
                    // $policys[$v['id']] = $v['name'];
                    $policys[$v['id']]['id'] = $v['id'];
                    $policys[$v['id']]['name'] = $v['name'];
                    if (in_array($v['type'], [1,2])) {
                        $aRules = json_decode($v['rules'], TRUE);
                        // var_dump($v);
                        // var_dump($aRules['data']);
                        $policys[$v['id']]['data'] = $aRules['data'];
                    } else {
                        $policys[$v['id']]['data'] = [];
                    }
                    // $policys[$v['id']] = $v;
                }
            } else {
                # code...
            }
            $aTem['policys'] = $policys;
            $aPrivilegePolicy[$value['id']] = $aTem;
        }

        // var_dump($aPrivilegePolicy);
        return $aPrivilegePolicy;
    }
}
