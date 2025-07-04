<?php

namespace App\Services;

use App\Models\TireService;
use App\Repositories\TireServiceRepository;
use Illuminate\Http\Request;

class TireStationService
{
    protected $tireServiceRepository;

    public  function __construct(TireServiceRepository $tireServiceRepository)
    {
        $this->tireServiceRepository = $tireServiceRepository;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['name', 'hasImage', 'room_1', 'room_2', 'room_3', 'room_4', "fromArea", "toArea"]);

        return $this->tireServiceRepository->search($filters)->paginate(20);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'room_count' => 'required|integer|min:0',
            'floor' => 'nullable|integer',
            'area' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        $tireService = TireService::findOrFail($id);

        // Если загружено новое изображение
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageInfo = getimagesize($image);
            $mime = $imageInfo['mime'];

            // Чтение изображения
            switch ($mime) {
                case 'image/jpeg':
                    $srcImage = imagecreatefromjpeg($image);
                    break;
                case 'image/png':
                    $srcImage = imagecreatefrompng($image);
                    break;
                default:
                    return back()->withErrors(['image' => 'Неподдерживаемый формат изображения.']);
            }

            // Получение оригинальных размеров
            $srcWidth = imagesx($srcImage);
            $srcHeight = imagesy($srcImage);

            $maxWidth = 800;
            if ($srcWidth > $maxWidth) {
                $ratio = $maxWidth / $srcWidth;
                $newWidth = $maxWidth;
                $newHeight = intval($srcHeight * $ratio);
                $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($resizedImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $srcWidth, $srcHeight);
            } else {
                $resizedImage = $srcImage;
            }


            if ($tireService->image_path && Storage::disk('public')->exists($tireService->image_path)) {
                Storage::disk('public')->delete($tireService->image_path);
            }


            $filename = 'tire_services/' . uniqid() . '.jpg';
            $fullPath = storage_path('app/public/' . $filename);
            imagejpeg($resizedImage, $fullPath, 75);

            imagedestroy($resizedImage);
            if ($srcImage !== $resizedImage) {
                imagedestroy($srcImage);
            }


            $tireService->image_path = $filename;
        }


        $tireService->name = $validated['name'];
        $tireService->room_count = $validated['room_count'];
        $tireService->floor = $validated['floor'];
        $tireService->area = $validated['area'];
        $tireService->description = $validated['description'];
        $tireService->save();
    }
}
