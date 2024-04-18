<fieldset disabled>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('Show Player') }}</div>

                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" id="name" name="name" autocomplete="name" placeholder="{{ __('Type your name') }}" class="form-control" value="{{ $player->name }}" required aria-describedby="nameHelp">
                                <small id="nameHelp" class="form-text text-muted">{{ __('We\'ll never share your data with anyone else.') }}</small>
                            </div>

                            <div class="form-group">
                                <label for="address">{{ __('Address') }}</label>
                                <input type="text" id="address" name="address" autocomplete="address" placeholder="{{ __('Type your address') }}" class="form-control" value="{{ $player->address }}" required aria-describedby="addressHelp">
                                <small id="addressHelp" class="form-text text-muted">{{ __('Enter your address.') }}</small>
                            </div>

                            <div class="form-group">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea class="form-control" name="description" id="description" rows="5" placeholder="{{ __('Type your description') }}" autocomplete="description">{{ $player->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="retired">{{ __('Retired') }}</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="retired" id="retired1" @if($player->retired == 1) checked @endif>
                                    <label class="form-check-label" for="retired1">{{ __('Yes') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="retired" id="retired0" @if($player->retired == 0) checked @endif>
                                    <label class="form-check-label" for="retired0">{{ __('No') }}</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>
<div class="container mt-4"> 
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-center">
                <a class="btn btn-primary btn-block" href="{{ url('players') }}" role="button">{{ __('Back') }}</a>
            </div>
        </div>
    </div>
</div>



