<?php
require_once($_SERVER['DOCUMENT_ROOT']."/include/db_info.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SERVER['HTTP_HOST']==$DOMAIN && isset($_SESSION[$OJ_NAME . '_user_id'])) {
        echo uploadAndCropImage($_SESSION[$OJ_NAME . '_user_id']);
    }
}

function uploadAndCropImage($profileName)
{
    $maxFileSize = 5 * 1024 * 1024; // 5MB

    // 업로드된 파일의 정보를 가져옵니다.
    $fileName = $_FILES["profileUpload"]["name"];
    $fileTmpName = $_FILES["profileUpload"]["tmp_name"];
    $fileSize = $_FILES["profileUpload"]["size"];

    // 파일 확장자를 체크하고 허용되는 확장자를 지정합니다.
    $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedExtensions)) {
        // 파일 크기를 체크하고 원하는 크기로 제한합니다.
        if ($fileSize <= $maxFileSize) {
            // 새로운 파일 이름을 생성합니다.
            $newFileName = $profileName . "." . $fileExtension;
            $webpFileName = $profileName . ".webp";
            $uploadPath = $_SERVER['DOCUMENT_ROOT'] . "/upload/";

            // 임시 파일의 경로를 UTF-8로 변환합니다.
            $utf8TmpFileName = mb_convert_encoding($fileTmpName, 'UTF-8', 'auto');

            // 파일을 이동시킵니다.
            if (move_uploaded_file($utf8TmpFileName, $uploadPath.$newFileName)) {
                // 크롭 함수를 호출하여 1:1 비율로 크롭합니다.
                cropImage($uploadPath.$newFileName, $uploadPath.$webpFileName, 300);
                unlink($uploadPath.$newFileName);

                return "프로필 사진 업로드 성공.";
            } else {
                return "프로필 사진 업로드 실패.";
            }
        } else {
            return "파일 크기가 너무 큽니다. 최대 파일 크기는 " . ($maxFileSize / (1024 * 1024)) . "MB입니다.";
        }
    } else {
        return "지원하지 않는 파일 형식입니다. jpg, jpeg, png, gif 파일만 허용됩니다.";
    }
}

// 크롭 함수
function cropImage($inputFileName, $outputFileName, $maxSize) {
    $fileExtension = strtolower(pathinfo($inputFileName, PATHINFO_EXTENSION));

    // 원본 이미지를 열고 크롭합니다.
    if ($fileExtension === "jpg" || $fileExtension === "jpeg") {
        $originalImage = imagecreatefromjpeg($inputFileName);
    } elseif ($fileExtension === "png") {
        $originalImage = imagecreatefrompng($inputFileName);
    } elseif ($fileExtension === "gif") {
        $originalImage = imagecreatefromgif($inputFileName);
    } else {
        die("지원하지 않는 파일 형식입니다.");
    }

    // 원본 이미지의 크기를 얻습니다.
    $originalWidth = imagesx($originalImage);
    $originalHeight = imagesy($originalImage);

    // 1:1 비율로 크롭할 영역을 계산합니다.
    if ($originalWidth > $originalHeight) {
        $cropWidth = $originalHeight;
        $cropHeight = $originalHeight;
        $startX = ($originalWidth - $originalHeight) / 2;
        $startY = 0;
    } else {
        $cropWidth = $originalWidth;
        $cropHeight = $originalWidth;
        $startX = 0;
        $startY = ($originalHeight - $originalWidth) / 2;
    }

    // 새로운 이미지를 생성하고 크롭합니다.
    $croppedImage = imagecrop($originalImage, ['x' => $startX, 'y' => $startY, 'width' => $cropWidth, 'height' => $cropHeight]);

    imagewebp($croppedImage, $outputFileName, 100); // 100은 WebP 이미지 품질 (0-100 범위)

    // 메모리에서 이미지 객체를 제거합니다.
    imagedestroy($originalImage);
    imagedestroy($croppedImage);
}
?>