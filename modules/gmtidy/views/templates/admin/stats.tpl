<div class="row clearfix">
    <div class="panel col-md-12">
        <div class="panel-heading">
            {l s='Statistics' mod='gmtidy'}
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center"><span class="title_box active">{l s='Abandoned carts' mod='gmtidy'}</span></th>
                    <th class="text-center"><span class="title_box active">{l s='Connection stats' mod='gmtidy'}</span></th>
                    <th class="text-center"><span class="title_box active">{l s='Search stats' mod='gmtidy'}</span></th>
                    <th class="text-center"><span class="title_box active">{l s='Email logs' mod='gmtidy'}</span></th>
                    <th class="text-center"><span class="title_box active">{l s='Logs' mod='gmtidy'}</span></th>
                    <th class="text-center"><span class="title_box active">{l s='Expired specific prices' mod='gmtidy'}</span></th>
                    <th class="text-center"><span class="title_box active">{l s='Expired vouchers' mod='gmtidy'}</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">{$abandonedCarts}</td>
                    <td class="text-center">{$connectionsStats}</td>
                    <td class="text-center">{$searchStats}</td>
                    <td class="text-center">{$emailLogs}</td>
                    <td class="text-center">{$logs}</td>
                    <td class="text-center">{$expiredSpecificPrices}</td>
                    <td class="text-center">{$expiredVouchers}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>