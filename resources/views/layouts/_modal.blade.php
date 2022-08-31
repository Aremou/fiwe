<div class="modal fade" id="modal_sup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-warning" style="color: yellow"></i> Boite
                    de confirmation </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action={{ $route }} method="post">

                @csrf
                @method('delete')

                <div class="modal-body">
                    <input type="hidden" name="test" id="id">
                    <h5>Voulez-vous vraiment supprimer {{ $nom }}</h5>

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary mr-auto px-5" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-primary pull-right px-5" name="oui">Oui</button>
                </div>

            </form>
        </div>
    </div>
</div>
