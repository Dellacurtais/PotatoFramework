<?php

if (!function_exists("uploadImage")) {
    /**
     * Fazer upload de imagens
     * @param $input String nome do input do arquivo
     * @param string $size tamanho maxímo do Arquivo.. Ex: 5M, 10G ...
     * @param array $pixels enviar array com width e height permitdo Ex: [199,100]
     * @return String retorna nome do arquivo
     */
    function uploadImage($input, $size = "5M", $pixels = null){

        $Config = getConfig("upload");
        $storage = new \Upload\Storage\FileSystem(ROOT_PATH . $Config['image']);
        $file = new \Upload\File($input, $storage);
        $file->setName(\System\Libraries\UUID::v4() . "-" . ramdomCode(6));


        $Validations = [];
        $Validations[] = new \Upload\Validation\Mimetype(array('image/png', 'image/gif', 'image/jpeg', 'image/jpg'));
        $Validations[] = new \Upload\Validation\Size($size);
        if (!is_null($pixels) && is_array($pixels))
            $Validations[] = new \Upload\Validation\Dimensions($pixels[0], $pixels[1]);

        $file->addValidations($Validations);

        try {
            $file->upload();
            return $file->getNameWithExtension();
        } catch (\Exception $e) {
            return $file->getErrors();
        }
    }
}

if (!function_exists("imageCache")) {
    /**
     * Gerar imagem de cache
     * @param $filename
     * @param $width
     * @param $height
     * @return string
     */
    function imageCache($filename, $width, $height){
        $Config = getConfig('upload');
        $filename = str_replace(getConfig('base_url'), "/", $filename);
        $filename = str_replace($Config['image'], "", $filename);

        if (!is_file(ROOT_PATH. $Config['image'] . $filename)) {
            return $filename;
        }

        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        $image_old = $filename;
        $image_new = utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . (int)$width . 'x' . (int)$height . '.' . $extension;

        if (!is_file(ROOT_PATH. getConfig('cache_image') . $image_new) || (filectime(ROOT_PATH. $Config['image'] . $image_old) > filectime(ROOT_PATH. getConfig('cache_image') . $image_new))) {
            list($width_orig, $height_orig, $image_type) = getimagesize(ROOT_PATH. $Config['image'] . $image_old);

            if (!in_array($image_type, array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF))) {
                return ROOT_PATH. $Config['image'] . $image_old;
            }

            $path = '';
            $directories = explode('/', dirname($image_new));
            foreach ($directories as $directory) {
                $path = $path . '/' . $directory;
                if (!is_dir(ROOT_PATH. getConfig('cache_image') . $path)) {
                    @mkdir(ROOT_PATH. getConfig('cache_image')  . $path, 0777);
                }
            }

            if ($width_orig != $width || $height_orig != $height) {
                $image = new \System\Libraries\Images(ROOT_PATH. $Config['image'] . $image_old);
                $image->resize($width, $height);
                $image->save(ROOT_PATH. getConfig('cache_image'). $image_new);
            } else {
                copy(ROOT_PATH. $Config['image'] . $image_old, ROOT_PATH. getConfig('cache_image') . $image_new);
            }
        }

        $image_new = str_replace(' ', '%20', $image_new);
        return getConfig('cache_image').$image_new;
    }
}