<?php

namespace Src\Application\Read\OpenTabs;

use Codderz\Yoko\Support\Collection;
use Src\Application\Read\OpenTabs\Queries\GetActiveTableNumbers;
use Src\Application\Read\OpenTabs\Queries\GetInvoiceForTable;
use Src\Application\Read\OpenTabs\Queries\GetTabForTable;
use Src\Application\Read\OpenTabs\Queries\GetTodoListForWaiter;

interface OpenTabsInterface
{
    /* @return Collection<int> */
    public function getActiveTableNumbers(GetActiveTableNumbers $query): Collection;

    public function getInvoiceForTable(GetInvoiceForTable $query): TabInvoice;

    public function getTabForTable(GetTabForTable $query): TabStatus;

    /* @return Collection<int, Collection<TabItem>> */
    public function getTodoListForWaiter(GetTodoListForWaiter $query): Collection;
}
