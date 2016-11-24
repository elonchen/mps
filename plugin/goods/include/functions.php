<?php
/**
 * ���ָ����Ʒ����ͬ�������з����Լ��÷����µ��ӷ���
 */
function goods_category_tree($catid = 0,$ifview = '2')
{
	$data = read_static_cache('goods_category_tree');
	/****************************/
	/*������и�����������ӷ���*/
	/****************************/
	if($catid == 0) {
		
		if($data === false){
			
			$parentid = 0;
			$bif_view = ($ifview == '2' || $ifview == '1') ? " AND a.if_view = '$ifview' AND b.if_view = '$ifview'" : "";
			$sql = "SELECT a.catid, a.catname, a.color, a.if_view, b.catid AS childid, b.catname AS childname FROM `{$GLOBALS['db_mymps']}goods_category` AS a LEFT JOIN `{$GLOBALS['db_mymps']}goods_category` AS b ON b.parentid = a.catid WHERE a.parentid = '$parentid' {$bif_view} ORDER BY a.catorder ASC , catid ASC, b.catorder ASC";
			$res = $GLOBALS['db']->getAll($sql);
		
			$cat_arr = array();
			
			foreach ($res AS $row){
				
				if ($row['if_view']){
					$cat_arr[$row['catid']]['catid']    = $row['catid'];
					$cat_arr[$row['catid']]['catname']  = $row['catname'];
					$cat_arr[$row['catid']]['color']	= $row['color'];
					$cat_arr[$row['catid']]['if_view']  = $row['if_view'];
		
					if ($row['childid'] != NULL){
						$cat_arr[$row['catid']]['children'][$row['childid']]['catid']    = $row['childid'];
						$cat_arr[$row['catid']]['children'][$row['childid']]['catname']  = $row['childname'];
						$cat_arr[$row['catid']]['children'][$row['childid']]['if_view']  = $row['if_view'];
						$cat_arr[$row['catid']]['children'][$row['childid']]['color']= $row['childcolor'];
					}
				}
				
			}
			write_static_cache('goods_category_tree',$cat_arr);
		}else{
			$cat_arr = $data;
		} 

	} 
	/****************************/
	/*���һ��������������ӷ���*/
	/****************************/
	else {
		
		if($data === NULL || empty($data[$catid])){
			
			$bif_view = ($ifview == '2' || $ifview == '1') ? " AND b.if_view = '$ifview'" : "";
			$parentid = $GLOBALS['db']->getOne("SELECT parentid FROM `{$GLOBALS['db_mymps']}goods_category` WHERE catid = '$catid'");
			
			if ($parentid == 0){
				/* ��ȡ��ǰͬ�����༰���ӷ��� */
				$sql = "SELECT a.catid, a.catname, a.catorder, a.if_view, b.catid AS childid, b.catname AS childname, b.catorder AS childorder FROM `{$GLOBALS['db_mymps']}goods_category` AS a LEFT JOIN `{$GLOBALS['db_mymps']}goods_category` AS b ON b.parentid = a.catid {$bif_view} WHERE a.catid = '$catid' ORDER BY catorder ASC , catid ASC, childorder ASC";
				
			}else{
				/* ��ȡ��ǰ���༰�丸���� */
				$sql = "SELECT a.catid, a.catname, a.catorder, a.if_view, a.html_dir, a.htmlpath, b.catid AS childid, b.catname AS childname, b.catorder AS childorder FROM `{$GLOBALS['db_mymps']}goods_category` AS a LEFT JOIN `{$GLOBALS['db_mymps']}goods_category` AS b ON b.parentid = a.catid {$bif_view} WHERE b.parentid = '$parentid' ORDER BY catorder ASC , catid ASC, childorder ASC";
						
			}
				
			$res = $GLOBALS['db']->getAll($sql);
			
			$cat_arr = array();
			foreach ($res AS $row){
				if ($row['if_view']){
					$cat_arr[$row['catid']]['catid']    = $row['catid'];
					$cat_arr[$row['catid']]['catname']  = $row['catname'];
					$cat_arr[$row['catid']]['catorder'] = $row['catorder'];
					$cat_arr[$row['catid']]['if_view']  = $row['if_view'];
					if ($row['childid'] != NULL){
						$cat_arr[$row['catid']]['children'][$row['childid']]['catid']    = $row['childid'];
						$cat_arr[$row['catid']]['children'][$row['childid']]['catname']  = $row['childname'];
						$cat_arr[$row['catid']]['children'][$row['childid']]['if_view']  = $row['if_view'];
						$cat_arr[$row['catid']]['children'][$row['childid']]['catorder'] = $row['childorder'];
					}
				}
			}
			
		} else {
			$cat_arr[] = $data[$catid];
		}
	}
	
    return $cat_arr;
}

/**
 * ���ָ�������µ��ӷ��������
 *
 * @access  public
 * @param   int     $catid     �����ID
 * @param   int     $selected   ��ǰѡ�з����ID
 * @param   boolean $re_type    ���ص�����: ֵΪ��ʱ���������б�,���򷵻�����
 * @param   int     $level      �޶����صļ�����Ϊ0ʱ�������м���
 * @param   int     $is_show_all ���Ϊtrue��ʾ���з��࣬���Ϊfalse���ز��ɼ����ࡣ
 * @return  mix
 */
function goods_cat_list($catid = 0, $selected = 0, $re_type = true, $level = 0, $is_show_all = true)
{
	$data = read_static_cache('goods_category_pid_releate');
	if ($data === false){

		$sql = "SELECT c.catid, c.catname, c.parentid, c.if_view, c.catorder, COUNT(s.catid) AS has_children FROM `{$GLOBALS['db_mymps']}goods_category` AS c LEFT JOIN `{$GLOBALS['db_mymps']}goods_category` AS s ON s.parentid=c.catid GROUP BY c.catid ORDER BY c.parentid, c.catorder ASC";
		
		$res = $GLOBALS['db']->getAll($sql);
		
		$sql = NULL;
				
		$newres = array();
		
		//���������󣬲����þ�̬���淽ʽ
		if (count($res) <= 1000){
			write_static_cache('goods_category_pid_releate', $res);
		}
	} else {
		$res = $data;
	}


    if (empty($res) == true){
        return $re_type ? '' : array();
    }

    $options = goods_cat_options($catid, $res); // ���ָ�������µ��ӷ��������

    $children_level = 99999; //�����������Ľ���ɾ��
    if ($is_show_all == false){
        foreach ($options as $key => $val){
            if ($val['level'] > $children_level){
                unset($options[$key]);
            }else{
                if ($val['is_show'] == 0){
                    unset($options[$key]);
                    if ($children_level > $val['level']){
                        $children_level = $val['level']; //���һ�£������ӷ���Ҳ��ɾ��
                    }
                }else{
                    $children_level = 99999; //�ָ���ʼֵ
                }
            }
        }
    }

    /* ��ȡ��ָ������������ */
    if ($level > 0){
        if ($catid == 0){
            $end_level = $level;
        }else{
            $first_item = reset($options); // ��ȡ��һ��Ԫ��
            $end_level  = $first_item['level'] + $level;
        }

        /* ����levelС��end_level�Ĳ��� */
        foreach ($options AS $key => $val){
            if ($val['level'] >= $end_level){
                unset($options[$key]);
            }
        }
    }

	if ($re_type == true){
		$select = '';
		foreach ($options AS $var){
			$select .= '<option value="' . $var['catid'] . '" ';
			if(is_array($selected)){
				$select .= in_array($var['catid'],$selected) ? "selected='ture' style='background-color:#6eb00c; color:white!important;'" : '';
			} else {
				$select .= ($selected == $var['catid']) ? "selected='ture' style='background-color:#6eb00c; color:white!important;'" : '';
			}
			$select .= '>';
			if ($var['level'] > 0){
				$select .= str_repeat('&nbsp;', $var['level'] * 4);
			}
			$select .= '�� '.mhtmlspecialchars($var['catname'], ENT_QUOTES) . '</option>';
		}
		return $select;
	}else{
		foreach ($options as $key => $value){
			$options[$key]['url'] = $value['catid'];
		}
		return $options;
	}

}

/**
 * ���˺��������з��࣬����һ�������������������
 *
 * @access  private
 * @param   int     $catid     �ϼ�����ID
 * @param   array   $arr        �������з��������
 * @param   int     $level      ����
 * @return  void
 */
function goods_cat_options($spec_catid, $arr)
{
    $cat_options = array();

    if (isset($cat_options[$spec_cat_id])){
        return $cat_options[$spec_cat_id];
    }

    if (!isset($cat_options[0])){
        $level = $last_cat_id = 0;
        $options = $cat_id_array = $level_array = array();
        $data = read_static_cache('goods_category_option_static');

        if ($data === false){
            while (!empty($arr)){
                foreach ($arr AS $key => $value){

                    $cat_id = $value['catid'];
                    if ($level == 0 && $last_cat_id == 0){
                        if ($value['parentid'] > 0){
                            break;
                        }
                        $options[$cat_id]          = $value;
                        $options[$cat_id]['level'] = $level;
                        $options[$cat_id]['id']    = $cat_id;
                        $options[$cat_id]['name']  = $value['catname'];
                        unset($arr[$key]);

                        if ($value['has_children'] == 0){
                            continue;
                        }
                        $last_cat_id  = $cat_id;
                        $cat_id_array = array($cat_id);
                        $level_array[$last_cat_id] = ++$level;
                        continue;
                    }

                    if ($value['parentid'] == $last_cat_id){
                        $options[$cat_id]          = $value;
                        $options[$cat_id]['level'] = $level;
                        $options[$cat_id]['id']    = $cat_id;
                        $options[$cat_id]['name']  = $value['catname'];
                        unset($arr[$key]);

                        if ($value['has_children'] > 0){
                            if (end($cat_id_array) != $last_cat_id){
                                $cat_id_array[] = $last_cat_id;
                            }
                            $last_cat_id    = $cat_id;
                            $cat_id_array[] = $cat_id;
                            $level_array[$last_cat_id] = ++$level;
                        }
                    } elseif ($value['parentid'] > $last_cat_id){
                        break;
                    }
                }

                $count = count($cat_id_array);
                if ($count > 1){
                    $last_cat_id = array_pop($cat_id_array);
                }elseif ($count == 1){
                    if ($last_cat_id != end($cat_id_array)){
                        $last_cat_id = end($cat_id_array);
                    }else{
                        $level = 0;
                        $last_cat_id = 0;
                        $cat_id_array = array();
                        continue;
                    }
                }

                if ($last_cat_id && isset($level_array[$last_cat_id])){
                    $level = $level_array[$last_cat_id];
                }else{
                    $level = 0;
                }
            }
            //���������󣬲����þ�̬���淽ʽ
            if (count($options) <= 2000){
                write_static_cache('goods_category_option_static', $options);
            }
        }else{
            $options = $data;
        }
        $cat_options[0] = $options;
    }else{
        $options = $cat_options[0];
    }

    if (!$spec_cat_id){
        return $options;
    }else{
        if (empty($options[$spec_cat_id])){
            return array();
        }

        $spec_cat_id_level = $options[$spec_cat_id]['level'];

        foreach ($options AS $key => $value){
            if ($key != $spec_cat_id){
                unset($options[$key]);
            }else{
                break;
            }
        }

        $spec_cat_id_array = array();
        foreach ($options AS $key => $value){
            if (($spec_cat_id_level == $value['level'] && $value['catid'] != $spec_cat_id) ||
                ($spec_cat_id_level > $value['level'])){
                break;
            }else{
                $spec_cat_id_array[$key] = $value;
            }
        }
        $cat_options[$spec_cat_id] = $spec_cat_id_array;

        return $spec_cat_id_array;
    }
}

/*
 * ���ָ������������ϼ�����
 */
function goods_parent_cats($cat='')
{
	
    if ($cat == 0) return array();

    $data = read_static_cache('goods_category_pid_releate');
   	if($data === false){
		$arr = $GLOBALS['db']->getAll("SELECT catid, catname, parentid FROM `{$GLOBALS['db_mymps']}goods_category`") ;
	} else {
		$arr = $data;
	}

    if (empty($arr)) return array();

    $index = 0;
    $cats  = array();

    while (1){
		foreach ($arr AS $row){
			if ($cat == $row['catid']){
				$cat = $row['parentid'];
				$cats[$index]['catid']   = $row['catid'];
				$cats[$index]['catname'] = $row['catname'];
				$cats[$index]['uri'] 	 = plugin_url('goods',array('catid'=>$row['catid']));
				$index++;
				break;
			}
		}
		
        if ($index == 0 || $cat == 0){
            break;
        }
    }
	
    return $cats;
}
?>