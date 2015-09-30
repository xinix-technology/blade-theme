<link rel="stylesheet" href="{{ Theme::base('vendor/blade-foundation/css/foundation-datepicker.css') }}">

<div id="{{ $id }}">
    <input
        type="text"
        value="{{ $value }}"
        class="datepicker"
        placeholder="{{ $self->label(true) }}"
    >
    <input type="hidden" name="{{ $self['name'] }}" class="to-post" >
</div>

<script type="text/javascript" charset="utf-8" src="{{ Theme::base('vendor/blade-foundation/js/moment.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ Theme::base('vendor/blade-foundation/js/foundation-datepicker.js') }}"></script>

<script type="text/javascript">
    var $date = $('#{{ $id }} .datepicker'),
        $dateToPost = $('#{{ $id }} .to-post');

    $date.fdatepicker({
        "format": "dd-mm-yyyy"
    }).on('changeDate', function(ev) {
        var value = moment($(ev.target).val(), 'DD-MM-YYYY').format('YYYY-MM-DD'),
            inputHidden = $(this).parent().find('.to-post');

        inputHidden.val(value);
    });

    $(function() {
        if($date.val().length !== 0 ) {
            var theDate = moment($date.val(), 'DD-MM-YYYY').format('DD-MM-YYYY'),
                theDateHidden = moment($date.val(), 'DD-MM-YYYY').format('YYYY-MM-DD');

            $date.val(theDate);
            $dateToPost.val(theDateHidden);
        }
    });
</script>
