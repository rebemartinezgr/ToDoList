<?php
/*
 * @author Rebeca Martinez Garcia <r.martinezgr@gmail.com>
 */

include_once $_SERVER['DOCUMENT_ROOT'] . "/ToDoList/Model/Item.php";

/**
 * Renderer
 */
class ItemRenderer
{
    /**
     * Render item as HTML output
     *
     * @param Item $item
     * @return string
     */
    public function renderItem(Item $item): string
    {
        $remove = $this->renderRemove($item);
        $status = $this->renderStatus($item);
        $value = $this->renderValue($item);
        $category = $this->renderCategory($item);
        $date = $this->renderDate($item);

        return <<<ITEM
        <div class="container">
            <div class="row">
                <div class="col-sm-1">$status</div>
                <div class="col-sm-10">
                    <div class="form-check form-group">$value</div>
                </div>
                <div class="col-sm-1">$remove</div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-2">
                    $date
                </div>
                <div class="col-sm-9">
                    $category
                </div>
                
            </div>
        </div>
        ITEM;
    }

    /**
     * Render value item as HTML output
     *
     * @param Item $item
     * @return string
     */
    public function renderValue(Item $item): string
    {
        $value = $item->getValue();
        $openDelTag = $item->getStatus() ? '<del>' : '';
        $closeDelTag = $item->getStatus() ? '</del>' : '';
        $id = $item->getId();
        return <<<VALUE
            <label id='value-$id' 
                for='status-$id' 
                class='form-check-label'>
                $openDelTag $value $closeDelTag
            </label>
        VALUE;
    }

    /**
     * Render status item as HTML output
     *
     * @param Item $item
     * @return string
     */
    public function renderStatus(Item $item): string
    {
        $status = $item->getStatus() ? 'checked' : '';
        $id = $item->getId();
        return <<<STATUS
            <input id='status-$id' 
            class='form-check-input' 
            data-id='$id' 
            type='checkbox' $status 
            onclick='handleStatusClick(this);'>
        STATUS;
    }

    /**
     * Render remove button item as HTML output
     *
     * @param Item $item
     * @return string
     */
    public function renderRemove(Item $item): string
    {
        $id = $item->getId();
        return <<<REMOVE
        <button type="button" 
            class="btn btn-outline-danger btn-sm" 
            class="remove-button" 
            data-id="$id" 
            onclick='handleRemoveItem(this)'>
            <i class="fa fa-close"></i>
        </button>
        REMOVE;
    }

    /**
     * Render category label as HTML output
     *
     * @param Item $item
     * @return string
     */
    public function renderCategory(Item $item): string
    {
        $category = $item->getCategoryLabel();
        return <<<CATEGORY
        <span class="badge bg-light text-dark">$category</span>
        CATEGORY;
    }

    /**
     * Render date as HTML output
     *
     * @param Item $item
     * @return string
     */
    public function renderDate(Item $item): string
    {
        $date = date("d-m-Y", strtotime($item->getDate()));
        return <<<DATE
        <span class="badge bg-secondary">$date</span>
        DATE;
    }
}
