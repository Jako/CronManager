<?php
require_once (MODX_CORE_PATH . 'model/modx/processors/element/snippet/getlist.class.php');
class modCronjobSnippetGetListProcessor extends modSnippetGetListProcessor {

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $c->leftJoin('modCategory','Category');

        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                'name:LIKE' => '%'.$query.'%',
            ));
        }

        $id = $this->getProperty('id');
        if (!empty($id)) {
            $c->where(array(
                'id' => $id,
            ));
        }

        return $c;
    }
}

return 'modCronjobSnippetGetListProcessor';
