<div class="container">
    <div class="col-sm-12 no-padding ACCOUNT-HEADER-FOLD-CONTENT">
        <div class="col-sm-3">
            <h4>Files</h4>
            <p>{{ $fileCount }}</p>
        </div>
        <div class="col-sm-3">
            <h4>Sales</h4>
            <p>{{ $saleCount }}</p>
        </div>
        <div class="col-sm-3">
            <h4>Sales This Month</h4>
            <p>${{ $thisMonthEarned }}</p>
        </div>
        <div class="col-sm-3">
            <h4>Lifetime Sales</h4>
            <p>${{ $lifetimeEarned }}</p>
        </div>
    </div>
</div>