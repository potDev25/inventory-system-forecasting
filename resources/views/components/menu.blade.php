@props(['actdate'])
<div class="row mb-5" style="width: 70%; margin: auto;">
    <div class="col-xl-4">
        <center>
            <img src="/images/menu-1.gif" alt="" style="height: 150px; width: 150px" class="mb-2"><br>
            <a href="/view-inventory" class="btn btn-primary"><i class="fa-solid fa-warehouse"></i> Sales</a>
        </center>
    </div>
    <div class="col-xl-4">
        <center>
            <img src="/images/menu2.gif" alt="" style="height: 150px; width: 150px" class="mb-2"><br>
            <a href="/products" class="btn btn-warning"><i class="fa-solid fa-warehouse"></i> Products Manager</a>
        </center>
    </div>
    <div class="col-xl-4">
        <center>
            <img src="/images/menu3.gif" alt="" style="height: 150px; width: 150px" class="mb-2"><br>
            <a href="/reports?month={{$actdate}}" class="btn btn-success"><i class="fa-solid fa-chart-line"></i> Reports</a>
        </center>
    </div>
</div>