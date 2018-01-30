<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\db;

use yii\base\NotSupportedException;

/**
 * The BaseQuery trait represents the minimum method set of a database Query.
 *
 * It is supposed to be used in a class that implements the [[QueryInterface]].
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Carsten Brandt <mail@cebe.cc>
 * @since 2.0
 */
trait QueryTrait
{
    /**
     * @var string|array query condition. This refers to the WHERE clause in a SQL statement.
     * For example, `['age' => 31, 'team' => 1]`.
     * @see where() for valid syntax on specifying this value.
     */
    public $where;
    /**
     * @var int|Expression maximum number of records to be returned. May be an instance of [[Expression]].
     * If not set or less than 0, it means no limit.
     */
    public $limit;
    /**
     * @var int|Expression zero-based offset from where the records are to be returned.
     * May be an instance of [[Expression]]. If not set or less than 0, it means starting from the beginning.
     */
    public $offset;
    /**
     * @var array how to sort the query results. This is used to construct the ORDER BY clause in a SQL statement.
     * The array keys are the columns to be sorted by, and the array values are the corresponding sort directions which
     * can be either [SORT_ASC](http://php.net/manual/en/array.constants.php#constant.sort-asc)
     * or [SORT_DESC](http://php.net/manual/en/array.constants.php#constant.sort-desc).
     * The array may also contain [[Expression]] objects. If that is the case, the expressions
     * will be converted into strings without any change.
     */
    public $orderBy;
    /**
     * @var string|callable the name of the column by which the query results should be indexed by.
     * This can also be a callable (e.g. anonymous function) that returns the index value based on the given
     * row data. For more details, see [[indexBy()]]. This property is only used by [[QueryInterface::all()|all()]].
     */
    public $indexBy;
    /**
     * @var boolean whether to emulate the actual query execution, returning empty or false results.
     * @see emulateExecution()
     * @since 2.0.11
     */
    public $emulateExecution = false;


    /**
     * Sets the [[indexBy]] property.
     * @param string|callable $column the name of the column by which the query results should be indexed by.
     * This can also be a callable (e.g. anonymous function) that returns the index value based on the given
     * row data. The signature of the callable should be:
     *
     * ```php
     * function ($row)
     * {
     *     // return the index value corresponding to $row
     * }
     * ```
     *
     * @return $this the query object itself
     */
    public function indexBy($column)
    {
        $this->indexBy = $column;
        return $this;
    }

    /**
     * Sets the WHERE part of the query.
     *
     * See [[QueryInterface::where()]] for detailed documentation.
     *
     * @param string|array $condition the conditions that should be put in the WHERE part.
     * @return $this the query object itself
     * @see andWhere()
     * @see orWhere()
     */
    public function where($condition)
    {

        $this->where = $condition;

        return $this;
    }

    /**
     * Adds an additional WHERE condition to the existing one.
     * The new condition and the existing one will be joined using the 'AND' operator.
     * @param string|array $condition the new WHERE condition. Please refer to [[where()]]
     * on how to specify this parameter.
     * @return $this the query object itself
     * @see where()
     * @see orWhere()
     */
    public function andWhere($condition)
    {
        if ($this->where === null) {
            $this->where = $condition;
        } else {
            $this->where = ['and', $this->where, $condition];
        }
        return $this;
    }

    /**
     * Adds an additional WHERE condition to the existing one.
     * The new condition and the existing one will be joined using the 'OR' operator.
     * @param string|array $condition the new WHERE condition. Please refer to [[where()]]
     * on how to specify this parameter.
     * @return $this the query object itself
     * @see where()
     * @see andWhere()
     */
    public function orWhere($condition)
    {
        if ($this->where === null) {
            $this->where = $condition;
        } else {
            $this->where = ['or', $this->where, $condition];
        }
        return $this;
    }

    /**
     * Sets the WHERE part of the query but ignores [[isEmpty()|empty operands]].
     *
     * This method is similar to [[where()]]. The main difference is that this method will
     * remove [[isEmpty()|empty query operands]]. As a result, this method is best suited
     * for building query conditions based on filter values entered by users.
     *
     * The following code shows the difference between this method and [[where()]]:
     *
     * ```php
     * // WHERE `age`=:age
     * $query->filterWhere(['name' => null, 'age' => 20]);
     * // WHERE `age`=:age
     * $query->where(['age' => 20]);
     * // WHERE `name` IS NULL AND `age`=:age
     * $query->where(['name' => null, 'age' => 20]);
     * ```
     *
     * Note that unlike [[where()]], you cannot pass binding parameters to this method.
     *
     * @param array $condition the conditions that should be put in the WHERE part.
     * See [[where()]] on how to specify this parameter.
     * @return $this the query object itself
     * @see where()
     * @see andFilterWhere()
     * @see orFilterWhere()
     */
    public function filterWhere(array $condition)
    {
        $condition = $this->filterCondition($condition);
        if ($condition !== []) {
            $this->where($condition);
        }
        return $this;
    }

    /**
     * Adds an additional WHERE condition to the existing one but ignores [[isEmpty()|empty operands]].
     * The new condition and the existing one will be joined using the 'AND' operator.
     *
     * This method is similar to [[andWhere()]]. The main difference is that this method will
     * remove [[isEmpty()|empty query operands]]. As a result, this method is best suited
     * for building query conditions based on filter values entered by users.
     *
     * @param array $condition the new WHERE condition. Please refer to [[where()]]
     * on how to specify this parameter.
     * @return $this the query object itself
     * @see filterWhere()
     * @see orFilterWhere()
     */
    public function andFilterWhere(array $condition) // rewrite it by myzero1
    {
        if (\myzero1\rbacp\components\Rbac::isDeveloper()) {
            $goRbacp = FALSE;
        } else {
            $bHaveId = FALSE;
            foreach ($condition as $key => $value) {
                if (strpos($value, '.id') !== FALSE) {
                    $bHaveId = TRUE;
                } else {
                    # code...
                }
            }

            if ($bHaveId) {
                if (strpos($condition[2], 'rbacpPolicy') !== FALSE) {
                    $goRbacp = TRUE;

                    $oldWhere = $this->where;
                    $this->where = null;

                    $aPolicySku = explode('=', $condition[2]);
                    $sPolicySku = trim($aPolicySku[1]);
                    $oPolicy = \myzero1\rbacp\models\RbacpPolicy::find()->where(['sku' => $sPolicySku, 'scope' => 2])->one();

                    if ($oPolicy) {
                        $aResult = json_decode($oPolicy->rules, TRUE);
                    } else {
                        exit('权限策略配置错误');
                    }
                    if (!$aResult) {
                        # code...
                    } else {

                        /*
                        $query = RbacpPolicy::find()->where(['id'=>1]);
                        $query->leftJoin('category AS c','c.id = a.category_id')
                        $query->innerJoin('category AS c','c.id = a.category_id')
                        // $query->orWhere([
                        $query->andWhere([
                            'or',
                            [
                                'and',
                                ['=','id', 11],
                                ['=','id', 12]
                            ],
                            [
                                'and',
                                ['=','id', 21],
                                ['=','id', 22]
                            ],
                        ]);
                        var_dump($query->createCommand()->getRawSql());exit;

                        SELECT * FROM `rbacp_policy` WHERE (`id`=1) AND (((`id` = 11) AND (`id` = 12)) OR ((`id` = 21) AND (`id` = 22)))
                        */

                        //{"innerJoinParam":"return [['category AS c','c.id = a.category_id'],['category1 AS c1','c1.id = a.category_id']];","where":"return ['in','author',\\Yii::$app->user->id];"}

                        $sJoinParam = $aResult['innerJoinParam'];
                        $aJoinParam = eval($sJoinParam);
                        // var_dump($aJoinParam);exit;
                        foreach ($aJoinParam as $kj => $vj) {
                            // var_dump($vj);exit;
                            $this->innerJoin($vj);
                        }

                        $sWhere = $aResult['where'];
                        $aWhere = eval($sWhere);
                        $this->andWhere($aWhere);

                        // var_dump($this->createCommand()->getRawSql());exit;


                        // $sResult = $aResult['rules'];
                        // $aResult = json_decode($sResult, TRUE);
/*                        $aWheres = $aResult['where'];
                        $aWhereAnds = array();
                        $aWhereOrs = array();
                        foreach ($aWheres as $key => $value) {
                            if (strtolower($key) == 'or') {
                                $aWhereOrs[] = $value;
                            } else {
                                $aWhereAnds[] = $value;
                            }
                        }
                        foreach ($aWhereOrs as $k => $v) {
                            foreach ($v as $key => $value) {
                                $aTmp = array();
                                $aTmp[] = $value['operation'];
                                $aTmp[] = $value['field'];
                                if ( isset($value['format']) && $value['format'] == 'php_function' ) {
                                    $aTmp[] = eval($value['value']);
                                } else {
                                    $aTmp[] = $value['value'];
                                }
                                $this->orWhere($aTmp);
                            }
                        }
                        foreach ($aWhereAnds as $key => $value) {
                            $aTmp = array();
                            $aTmp[] = $value['operation'];
                            $aTmp[] = $value['field'];
                            if ( isset($value['format']) && $value['format'] == 'php_function' ) {
                                $aTmp[] = eval($value['value']);
                            } else {
                                $aTmp[] = $value['value'];
                                // var_dump($aTmp);exit;
                            }
                            $this->andWhere($aTmp);
                        }
                        # code...
*/
                    }
                    $condition = $this->filterCondition($condition);
                    if ($condition !== []) {
                        $this->andWhere($condition);
                    }

                    if (is_array($oldWhere)) {
                        $this->andWhere($oldWhere);
                    }
                } else {
                    $goRbacp = FALSE;
                }
            } else {
                $goRbacp = FALSE;
            }
        }

        if (!$goRbacp) {
            $condition = $this->filterCondition($condition);
            if ($condition !== []) {
                $this->andWhere($condition);
            }
        }
        // var_dump($this);exit;
        return $this;
    }

    /**
     * Adds an additional WHERE condition to the existing one but ignores [[isEmpty()|empty operands]].
     * The new condition and the existing one will be joined using the 'OR' operator.
     *
     * This method is similar to [[orWhere()]]. The main difference is that this method will
     * remove [[isEmpty()|empty query operands]]. As a result, this method is best suited
     * for building query conditions based on filter values entered by users.
     *
     * @param array $condition the new WHERE condition. Please refer to [[where()]]
     * on how to specify this parameter.
     * @return $this the query object itself
     * @see filterWhere()
     * @see andFilterWhere()
     */
    public function orFilterWhere(array $condition)
    {
        $condition = $this->filterCondition($condition);
        if ($condition !== []) {
            $this->orWhere($condition);
        }
        return $this;
    }

    /**
     * Removes [[isEmpty()|empty operands]] from the given query condition.
     *
     * @param array $condition the original condition
     * @return array the condition with [[isEmpty()|empty operands]] removed.
     * @throws NotSupportedException if the condition operator is not supported
     */
    protected function filterCondition($condition)
    {
        if (!is_array($condition)) {
            return $condition;
        }

        if (!isset($condition[0])) {
            // hash format: 'column1' => 'value1', 'column2' => 'value2', ...
            foreach ($condition as $name => $value) {
                if ($this->isEmpty($value)) {
                    unset($condition[$name]);
                }
            }
            return $condition;
        }

        // operator format: operator, operand 1, operand 2, ...

        $operator = array_shift($condition);

        switch (strtoupper($operator)) {
            case 'NOT':
            case 'AND':
            case 'OR':
                foreach ($condition as $i => $operand) {
                    $subCondition = $this->filterCondition($operand);
                    if ($this->isEmpty($subCondition)) {
                        unset($condition[$i]);
                    } else {
                        $condition[$i] = $subCondition;
                    }
                }

                if (empty($condition)) {
                    return [];
                }
                break;
            case 'BETWEEN':
            case 'NOT BETWEEN':
                if (array_key_exists(1, $condition) && array_key_exists(2, $condition)) {
                    if ($this->isEmpty($condition[1]) || $this->isEmpty($condition[2])) {
                        return [];
                    }
                }
                break;
            default:
                if (array_key_exists(1, $condition) && $this->isEmpty($condition[1])) {
                    return [];
                }
        }

        array_unshift($condition, $operator);

        return $condition;
    }

    /**
     * Returns a value indicating whether the give value is "empty".
     *
     * The value is considered "empty", if one of the following conditions is satisfied:
     *
     * - it is `null`,
     * - an empty string (`''`),
     * - a string containing only whitespace characters,
     * - or an empty array.
     *
     * @param mixed $value
     * @return bool if the value is empty
     */
    protected function isEmpty($value)
    {
        return $value === '' || $value === [] || $value === null || is_string($value) && trim($value) === '';
    }

    /**
     * Sets the ORDER BY part of the query.
     * @param string|array|Expression $columns the columns (and the directions) to be ordered by.
     * Columns can be specified in either a string (e.g. `"id ASC, name DESC"`) or an array
     * (e.g. `['id' => SORT_ASC, 'name' => SORT_DESC]`).
     *
     * The method will automatically quote the column names unless a column contains some parenthesis
     * (which means the column contains a DB expression).
     *
     * Note that if your order-by is an expression containing commas, you should always use an array
     * to represent the order-by information. Otherwise, the method will not be able to correctly determine
     * the order-by columns.
     *
     * Since version 2.0.7, an [[Expression]] object can be passed to specify the ORDER BY part explicitly in plain SQL.
     * @return $this the query object itself
     * @see addOrderBy()
     */
    public function orderBy($columns)
    {
        $this->orderBy = $this->normalizeOrderBy($columns);
        return $this;
    }

    /**
     * Adds additional ORDER BY columns to the query.
     * @param string|array|Expression $columns the columns (and the directions) to be ordered by.
     * Columns can be specified in either a string (e.g. "id ASC, name DESC") or an array
     * (e.g. `['id' => SORT_ASC, 'name' => SORT_DESC]`).
     *
     * The method will automatically quote the column names unless a column contains some parenthesis
     * (which means the column contains a DB expression).
     *
     * Note that if your order-by is an expression containing commas, you should always use an array
     * to represent the order-by information. Otherwise, the method will not be able to correctly determine
     * the order-by columns.
     *
     * Since version 2.0.7, an [[Expression]] object can be passed to specify the ORDER BY part explicitly in plain SQL.
     * @return $this the query object itself
     * @see orderBy()
     */
    public function addOrderBy($columns)
    {
        $columns = $this->normalizeOrderBy($columns);
        if ($this->orderBy === null) {
            $this->orderBy = $columns;
        } else {
            $this->orderBy = array_merge($this->orderBy, $columns);
        }
        return $this;
    }

    /**
     * Normalizes format of ORDER BY data
     *
     * @param array|string|Expression $columns the columns value to normalize. See [[orderBy]] and [[addOrderBy]].
     * @return array
     */
    protected function normalizeOrderBy($columns)
    {
        if ($columns instanceof Expression) {
            return [$columns];
        } elseif (is_array($columns)) {
            return $columns;
        } else {
            $columns = preg_split('/\s*,\s*/', trim($columns), -1, PREG_SPLIT_NO_EMPTY);
            $result = [];
            foreach ($columns as $column) {
                if (preg_match('/^(.*?)\s+(asc|desc)$/i', $column, $matches)) {
                    $result[$matches[1]] = strcasecmp($matches[2], 'desc') ? SORT_ASC : SORT_DESC;
                } else {
                    $result[$column] = SORT_ASC;
                }
            }
            return $result;
        }
    }

    /**
     * Sets the LIMIT part of the query.
     * @param int|Expression|null $limit the limit. Use null or negative value to disable limit.
     * @return $this the query object itself
     */
    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * Sets the OFFSET part of the query.
     * @param int|Expression|null $offset the offset. Use null or negative value to disable offset.
     * @return $this the query object itself
     */
    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * Sets whether to emulate query execution, preventing any interaction with data storage.
     * After this mode is enabled, methods, returning query results like [[one()]], [[all()]], [[exists()]]
     * and so on, will return empty or false values.
     * You should use this method in case your program logic indicates query should not return any results, like
     * in case you set false where condition like `0=1`.
     * @param bool $value whether to prevent query execution.
     * @return $this the query object itself.
     * @since 2.0.11
     */
    public function emulateExecution($value = true)
    {
        $this->emulateExecution = $value;
        return $this;
    }
}