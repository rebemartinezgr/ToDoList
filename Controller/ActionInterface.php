<?php
/*
 * @author Rebeca Martinez Garcia
 * @author Evelyn Bayas Meza
 * @author Daniel Hernández Arcos
 * @author Teodoro Tovar de la Hija
 */

/**
 * Action Interface
 */
interface ActionInterface
{
    /**
     * @return array
     */
    public function execute(): array;
}
