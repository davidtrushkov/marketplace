<div class="container">
    <div class="col-sm-12 no-padding ACCOUNT-HEADER-FOLD-CONTENT">
        <div class="col-sm-3">
            <h4>Total Files</h4>
            <p>{{ $fileCount }}</p>
        </div>
        <div class="col-sm-3">
            <h4>Total Sales</h4>
            <p>{{ $saleCount }}</p>
        </div>
        <div class="col-sm-3">
            <h4>Commission This Month</h4>
            <p>${{ $thisMonthCommission }}</p>
        </div>
        <div class="col-sm-3">
            <h4>Lifetime Commission</h4>
            <p>${{ $lifetimeCommission }}</p>
        </div>
    </div>
</div>