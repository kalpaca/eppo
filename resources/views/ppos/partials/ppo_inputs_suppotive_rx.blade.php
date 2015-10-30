<table class="table table-bordered ppo-rx">
<tbody>
<tr>
<td class="ppo-rx col-md-12">
    <p>
        <h3>Supportive Rx
        </h3>
    </p>
    <hr>
    <div class="ppo-items">
        <?php $index = 0;?>
        @foreach($ppo->ppoItems as $item)
            @if($item->ppo_section_id == 2)
                @include('ppo_items/partials/ppo_item_inputs', compact('index'))
                <?php $index++; ?>
            @endif
        @endforeach
    </div>
    </td>
</tr>
</tbody>
</table>