<div>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#ResetPassword{{ $id }}" >
  <i class="fas fa-lock-open"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="ResetPassword{{ $id }}" tabindex="-1" aria-labelledby="ResetPasswordLabel" aria-hidden="true">
    <form action="{{ route('users.reset-password') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $id }}">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ResetPasswordLabel">Form Reset Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Ketika Password User direset maka password menjadi default "<b>12345678</b>"</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger">Reset Password</button>
        </div>
        </div>
    </div>
  </form>
</div>
</div>