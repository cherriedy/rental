<?php

namespace Database\Seeders\Locations\HoChiMinh;

use Exception;
use Carbon\Carbon;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TanBinhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $DistrictName = 'Quận Tân Bình';

        try {
            Location::create([
                'name' => $DistrictName,
                'slug' => Str::slug($DistrictName),
                'title' => $DistrictName,
                'description' => $DistrictName,
                'parent_id' => 1,
                'type' => 2,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        } catch (Exception $exception) {
        }

        $this->call(TanBinhWardSeeder::class);
        $this->call(TanBinhStreetSeeder::class);
    }
}

class TanBinhWardSeeder extends Seeder
{
    public function run(): void
    {
        $wards = ['Phường 1', 'Phường 2', 'Phường 3', 'Phường 4', 'Phường 5', 'Phường 6', 'Phường 7', 'Phường 8', 'Phường 9', 'Phường 10', 'Phường 11', 'Phường 12', 'Phường 13', 'Phường 14', 'Phường 15'];

        foreach ($wards as $ward) {
            try {
                Location::create([
                    'name' => $ward,
                    'slug' => Str::slug($ward),
                    'title' => $ward,
                    'description' => $ward,
                    'parent_id' => 2,
                    'type' => 3,
                    'status' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            } catch (Exception $exception) {
            }
        }
    }
}

class TanBinhStreetSeeder extends Seeder {
    public function run(): void {
        $streets = [
            'Ấp Bắc',
            'Âu Cơ',
            'Ba Gia',
            'Ba Vân',
            'Ba Vì',
            'Bắc Hải',
            'Bạch Đằng',
            'Bạch Đằng 1',
            'Bạch Đằng 2',
            'Bạch Mã',
            'Bành Văn Trân',
            'Bàu Bàng',
            'Bàu Cát',
            'Bàu Cát 1',
            'Bàu Cát 2',
            'Bàu Cát 3',
            'Bàu Cát 4',
            'Bàu Cát 5',
            'Bàu Cát 6',
            'Bàu Cát 7',
            'Bàu Cát 8',
            'Bàu Cát 9',
            'Bàu Cát Đôi',
            'Bảy Hiền',
            'Bế Văn Đàn',
            'Bến Cát',
            'Bình Giã',
            'Bùi Thế Mỹ',
            'Bùi Thị Xuân',
            'Bùi Tư Toàn',
            'Ca Văn Thỉnh',
            'Cách Mạng Tháng 8',
            'Cầu Cống Lở',
            'Chấn Hưng',
            'Châu Vĩnh Tế',
            'Chí Công',
            'Chí Linh',
            'Chử Đồng Tử',
            'Cộng Hòa',
            'Cống Lở',
            'Cù Chính Lan',
            'Cửu Long',
            'Đại Nghĩa',
            'Dân Trí',
            'Đặng Lộ',
            'Đặng Minh Trứ',
            'Đất Thánh',
            'Đinh Điền',
            'Đồ Sơn',
            'Đống Đa',
            'Đồng Đen',
            'Đông Hồ',
            'Đồng Khởi',
            'Đồng Nai',
            'Đông Sơn',
            'Đồng Xoài',
            'Đường 27 Tháng 3',
            'Đường A4',
            'Đường B1',
            'Đường B6',
            'Đường C1',
            'Đường C12',
            'Đường C18',
            'Đường C2',
            'Đường C22',
            'Đường C27',
            'Đường C3',
            'Đường D10',
            'Đường D50',
            'Đường D51',
            'Đường D52',
            'Đường số 1',
            'Đường số 175',
            'Đường số 2',
            'Đường số 3',
            'Đường số 4',
            'Đường số 5',
            'Đường số 6',
            'Đường số 7',
            'Dương Văn Dương',
            'Dương Vân Nga',
            'Duy Tân',
            'Giải Phóng',
            'Gò Cẩm Đệm',
            'Gò Dầu',
            'Hà Bá Tường',
            'Hát Giang',
            'Hậu Giang',
            'Hiệp Nhất',
            'Hồ Đắc Di',
            'Hòa Bình',
            'Hòa Hiệp',
            'Hoàng Bật Đạt',
            'Hoàng Hoa Thám',
            'Hoàng Kế Viêm',
            'Hoàng Sa',
            'Hoàng Văn Thụ',
            'Hoàng Việt',
            'Hồng Hà',
            'Hồng Lạc',
            'Hưng Hóa',
            'Hương lộ 2',
            'Huỳnh Lan Khanh',
            'Huỳnh Tịnh Của',
            'Huỳnh Văn Nghệ',
            'Kênh Nhiêu Lộc',
            'Khai Quang',
            'Khai Trí',
            'Khuông Việt',
            'Lạc Long Quân',
            'Lam Sơn',
            'Lê Bình',
            'Lê Duy Nhuận',
            'Lê Lai',
            'Lê Lợi',
            'Lê Minh Xuân',
            'Lê Ngân',
            'Lê Tấn Quốc',
            'Lê Trọng Tấn',
            'Lê Trung Nghĩa',
            'Lê Văn Huân',
            'Lê Văn Sỹ',
            'Lộc Hưng',
            'Lộc Vinh',
            'Long Hưng',
            'Lương Thế Vinh',
            'Lưu Nhân Chú',
            'Lý Thường Kiệt',
            'Mai Lão Bạng',
            'Năm Châu',
            'Nghĩa Hòa',
            'Nghĩa Hưng',
            'Nghĩa Phát',
            'Ngô Bệ',
            'Ngô Thị Thu Minh',
            'Ngự Bình',
            'Nguyễn Bá Tòng',
            'Nguyễn Bá Tuyển',
            'Nguyễn Bặc',
            'Nguyễn Cảnh Dị',
            'Nguyễn Chánh Sắt',
            'Nguyễn Đình Khơi',
            'Nguyễn Đức Thuận',
            'Nguyễn Hiến Lê',
            'Nguyễn Hồng Đào',
            'Nguyễn Minh Hoàng',
            'Nguyễn Phúc Chu',
            'Nguyễn Quang Bích',
            'Nguyễn Sơn',
            'Nguyễn Sỹ Sách',
            'Nguyễn Thái Bình',
            'Nguyễn Thanh Tuyền',
            'Nguyễn Thế Lộc',
            'Nguyễn Thị Nhỏ',
            'Nguyễn Trọng Lội',
            'Nguyễn Trọng Tuyển',
            'Nguyễn Tử Nha',
            'Nguyễn Văn Mại',
            'Nguyễn Văn Trỗi',
            'Nguyễn Văn Vĩ',
            'Nguyễn Văn Vĩnh',
            'Nguyễn Xuân Khoát',
            'Nhất Chi Mai',
            'Ni Sư Huỳnh Liên',
            'Núi Thành',
            'Phạm Cự Lượng',
            'Phạm Hồng Thái',
            'Phạm Phú Thứ',
            'Phạm Văn Bạch',
            'Phạm văn hai',
            'Phan Anh',
            'Phan Bá Phiến',
            'Phan Đình Giót',
            'Phan Huy Ích',
            'Phan Sào Nam',
            'Phan Thúc Duyện',
            'Phan Văn Lâu',
            'Phan Văn Sửu',
            'Phổ Quang',
            'Phú Hoà',
            'Phú Lộc',
            'Quách Văn Tuấn',
            'Quảng Hiền',
            'Sầm Sơn',
            'Sao Mai',
            'Sơn Cang',
            'Sơn Hưng',
            'Sông Đà',
            'Sông Đáy',
            'Sông Nhuệ',
            'Sông Thao',
            'Sông Thương',
            'Tân Canh',
            'Tân Châu',
            'Tân Hải',
            'Tân Khai',
            'Tân Kỳ Tân Quý',
            'Tân Lập',
            'Tân Phước',
            'Tân Sơn',
            'Tân Sơn Hòa',
            'Tân Sơn Nhì',
            'Tân Tạo',
            'Tân Thọ',
            'Tân Tiến',
            'Tân Trang',
            'Tân Trụ',
            'Tản Viên',
            'Tân Xuân',
            'Thái Thị Nhạn',
            'Thân Nhân Trung',
            'Thăng Long',
            'Thành Mỹ',
            'Thép Mới',
            'Thích Minh Nguyệt',
            'Thiên Phước',
            'Thủ Khoa Huân',
        ];

        foreach ($streets as $street) {
            try {
                Location::create([
                    'name' => $street,
                    'slug' => Str::slug($street),
                    'title' => $street,
                    'description' => $street,
                    'parent_id' => 2,
                    'type' => 4,
                    'status' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            } catch (Exception $exception) {
            }
        }
    }
}
