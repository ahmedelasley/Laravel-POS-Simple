<!-- Basic modal -->
<div wire:ignore.self class="modal fade" id="payAmountModel" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Pay Now</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" >
                    <div class="form-group">
                        {{-- <div wire:init>
                            Current time: {{ now() }}
                        </div> --}}
                        {{-- <input class="form-control" type="text" name="subTotal" value="{{ $subTotal }}" readonly> --}}
                        <label class="main-content-label tx-12 tx-medium">Pay Amount</label>
                        <input class="form-control" type="text" name="amount" wire:model='amount' >
                        @error('amount')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                        {{-- <h1>{{$amount1 }}</h1> --}}
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="button" wire:click.prevent="pay()">Pay</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->