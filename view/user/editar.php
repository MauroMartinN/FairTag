<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>


<form action="index.php?c=User&a=actualizar" method="POST" enctype="multipart/form-data" class="form-container">
    <h2 class="base">Editar Perfil</h2>
    <br>
    <?php if (isset($errorMessage)): ?>
        <p class="alert-danger"><?= htmlspecialchars($errorMessage) ?></p>
    <?php endif; ?>
    <div>
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($user->getName()) ?>" required>
    </div>

    <div>
        <label for="image" class="seleccionar-imagen-label">Cambiar imagen</label>
        <input type="file" id="image" name="image" accept="image/*" style="display:none;">

        <?php if ($user->getImage()): ?>
            <p style="text-align: center;">Imagen actual:</p>
            <img src="userImg/<?= htmlspecialchars($user->getImage()) ?>" alt="Imagen de perfil" class="perfil-img"
                style="display: block; margin: 0 auto;">
        <?php endif; ?>
        <br>

        <input type="hidden" name="cropped_image" id="cropped_image">
    </div>

    <button type="submit">Guardar Cambios</button>
    <br><br>
    <a href="index.php?c=User&a=perfil">Volver al perfil</a>
</form>

<div id="cropper-modal" style="display: none;">
    <div>
        <h3>Recortar imagen</h3>
        <img id="image-to-crop" />
        <div style="margin-top: 15px;">
            <button type="button" id="crop-button">Recortar</button>
            <button type="button" id="cancel-crop">Cancelar</button>
        </div>
    </div>
</div>


<script>
    const imageInput = document.getElementById('image');
    const cropperModal = document.getElementById('cropper-modal');
    const imageToCrop = document.getElementById('image-to-crop');
    const cropButton = document.getElementById('crop-button');
    const cancelCrop = document.getElementById('cancel-crop');
    const croppedImageInput = document.getElementById('cropped_image');

    let cropper = null;

    imageInput.addEventListener('change', function (e) {
        const files = e.target.files;
        if (files && files.length > 0) {
            const file = files[0];
            const url = URL.createObjectURL(file);
            imageToCrop.src = url;
            cropperModal.style.display = 'flex';

            if (cropper) {
                cropper.destroy();
            }

            cropper = new Cropper(imageToCrop, {
                aspectRatio: 1,
                viewMode: 1,
                dragMode: 'move',
                guides: false,
                background: false,
                modal: true,
                cropBoxResizable: true,
                cropBoxMovable: true,
                minCropBoxWidth: 100,
                minCropBoxHeight: 100,
                movable: true,
                rotatable: false,
                scalable: false,
                zoomable: true,
                ready() {
                    const cropBox = this.cropper.cropBox;
                    cropBox.style.borderRadius = '50%';
                }
            });
        }
    });

    cropButton.addEventListener('click', function () {
        if (!cropper) return;

        const canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
            imageSmoothingQuality: 'high'
        });

        const base64data = canvas.toDataURL('image/png');

        croppedImageInput.value = base64data;

        let preview = document.querySelector('.perfil-img');
        if (preview) {
            preview.src = base64data;
        } else {
            const img = document.createElement('img');
            img.className = 'perfil-img';
            img.src = base64data;
            imageInput.parentNode.appendChild(img);
        }

        cropperModal.style.display = 'none';
        cropper.destroy();
        cropper = null;

        imageInput.value = '';
    });

    cancelCrop.addEventListener('click', function () {
        cropperModal.style.display = 'none';
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        imageInput.value = '';
    });
</script>