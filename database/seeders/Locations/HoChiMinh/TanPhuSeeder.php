<?php

namespace Database\Seeders\Locations\HoChiMinh;

use Exception;
use Carbon\Carbon;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TanPhuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $DistrictName = 'Quận Tân Phú';

        try {
            $TANPHU = Location::create([
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

        $this->call(TanPhuWardSeeder::class);
        $this->call(TanPhuStreetSeeder::class);
    }
}

class TanPhuWardSeeder extends Seeder
{
    public function run(): void
    {
        $wards = ['Tân Sơn Nhì', 'Tây Thạnh', 'Sơn Kỳ', 'Tân Quý', 'Tân Thành', 'Phú Thọ Hòa', 'Phú Thạnh', 'Phú Trung', 'Hòa Thạnh', 'Hiệp Tân', 'Tân Thới Hòa'];

        foreach ($wards as $ward) {
            try {
                Location::create([
                    'name' => $ward,
                    'slug' => Str::slug($ward),
                    'title' => $ward,
                    'description' => $ward,
                    // 'parent_id' => $TANPHU->id,
                    'parent_id' => 944,
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

class TanPhuStreetSeeder extends Seeder
{
    public function run(): void
    {
        $streets = [
            'Âu Cơ',
            'Đường CN13',
            'Khuông Việt',
            'Nguyễn Văn Ngọc',
            'Âu Dương Lân',
            'Đường CN6',
            'Lê Cảnh Tuân',
            'Nguyễn Văn Săng',
            'Bác Ái',
            'Đường D10',
            'Lê Cao Lãng',
            'Nguyễn Văn Tố',
            'Bình Long',
            'Đường D11',
            'Lê Đại',
            'Nguyễn Văn Vịnh',
            'Bờ Bao Tân Thắng',
            'Đường D12',
            'Lê Đình Thám',
            'Nguyễn Xuân Khoát',
            'Bùi Cẩm Hổ',
            'Đường D13',
            'Lê Đình Thụ',
            'Phạm Đăng Giảng',
            'Bùi Thế Mỹ',
            'Đường D14A',
            'Lê Khôi',
            'Phạm Phú Thứ',
            'Bùi Xuân Phái',
            'Đường D14B',
            'Lê Lâm',
            'Phạm Văn Bạch',
            'Cách Mạng',
            'Đường D15',
            'Lê Lăng',
            'Phạm Văn Chiêu',
            'Cách Mạng Tháng 8',
            'Đường D16',
            'Lê Lộ',
            'Phạm Văn Hai',
            'Cao thế',
            'Đường D9',
            'Lê Lư',
            'Phạm Văn Xảo',
            'Cao Văn ngọc',
            'Đường DC1',
            'Lê Ngã',
            'Phan Anh',
            'Cầu Xéo',
            'Đường DC11',
            'Lê Niệm',
            'Phan Chu Trinh',
            'Cây Keo',
            'Đường DC13',
            'Lê Quang Chiểu',
            'Phan Đình Phùng',
            'Chân Lý',
            'Đường DC3',
            'Lê Quốc Trinh',
            'Phan Văn Năm',
            'Chế Lan Viên',
            'Đường DC4',
            'Lê Sao',
            'Phố Chợ',
            'Chu Thiên',
            'Đường DC5',
            'Lê Sát',
            'Phú Thọ Hòa',
            'Chu Văn An',
            'Đường DC7',
            'Lê Thận',
            'Phùng Chí Kiên',
            'Cộng Hòa 3',
            'Đường DC9',
            'Lê Thiệt',
            'Quách Đình Bảo',
            'Dân Chủ',
            'Dương Đức Hiền',
            'Lê Thúc Hoạch',
            'Quách Hữu Nghiêm',
            'Dân Tộc',
            'Dương Khuê',
            'Lê Trọng Tấn',
            'Quách Vũ',
            'Điện Cao Thế',
            'Dương Thiệu Tước',
            'Lê Trúc',
            'Sơn Kỳ',
            'Diệp Minh Châu',
            'Đường Kênh 19/5',
            'Lê Trung Đình',
            'Tân Hương',
            'Đinh Liệt',
            'Đường M5',
            'Lê Văn Phan',
            'Tân Kỳ Tân Quý',
            'Đỗ Bí',
            'Đường S1',
            'Lê Vĩnh Hòa',
            'Tân Quý',
            'Đỗ Công Tường',
            'Đường S11',
            'Lê Văn Tuyết',
            'Tân Sơn Nhì',
            'Đỗ Đức Dục',
            'Đường S3',
            'Lê Văn Việt',
            'Tân Thành',
            'Đỗ Nhuận',
            'Đường S5',
            'Lê Văn Xương',
            'Tây Sơn',
            'Đỗ Thị Tâm',
            'Đường S7',
            'Lý Thái Tông',
            'Tây Thạnh',
            'Đỗ Thừa Luông',
            'Đường S9',
            'Lý Thánh Tông',
            'Thạch Lam',
            'Đỗ Thừa Tự',
            'Đường T1',
            'Lý Tuệ',
            'Thẩm Mỹ',
            'Đoàn Giỏi',
            'Đường T4A',
            'Ngô Quyền',
            'Thành Công',
            'Đoàn Hồng Phước',
            'Đường T4B',
            'Nguyễn Bá Tòng',
            'Thoại Ngọc Hầu',
            'Đoàn Kết',
            'Đường T5',
            'Nguyễn Chích',
            'Thống Nhất',
            'Độc Lập',
            'Đường T6',
            'Nguyễn Cửu Đàm',
            'tổ 46',
            'Đường 30 Tháng 4',
            'Đường T8',
            'Nguyễn Cửu Phú',
            'Tổ 48',
            'Đường B',
            'Dương Văn Dương',
            'Nguyễn Dữ',
            'Tô Hiệu',
            'Đường B2',
            'Gò Dầu',
            'Nguyễn Hảo Vĩnh',
            'Trần Đình Trọng',
            'Đường B3',
            'Gò Xoài',
            'Nguyễn Hậu',
            'Trần Hưng Đạo',
            'Đường C1',
            'Hàn Mặc Tử',
            'Nguyễn Hữu Dật',
            'Trần Quang Cơ',
            'Đường C4',
            'Hiền Vương',
            'Nguyễn Hữu Tiến',
            'Trần Tấn',
            'Đường C4A',
            'Hồ Đắc Di',
            'Nguyễn Lộ Trạch',
            'Trần Thủ Độ',
            'Đường C5',
            'Hồ Ngọc Cẩn',
            'Nguyễn Lý',
            'Trần Văn Cẩn',
            'Đường C6',
            'Hoa Bằng',
            'Nguyễn Minh Châu',
            'Trần Văn Giáp',
            'Đường C6A',
            'Hòa Bình',
            'Nguyễn Mỹ Ca',
            'Trần Văn Ơn',
            'Đường C7',
            'Hoàng Ngọc Phách',
            'Nguyễn Ngọc Nhựt',
            'Trịnh Đình Thảo',
            'Đường C8',
            'Hoàng Thiều Hoa',
            'Nguyễn Quang Diệu',
            'Trịnh Đình Trọng',
            'Đường CC1',
            'Hoàng Văn Hòe',
            'Nguyễn Quý Anh',
            'Trịnh Lỗi',
            'Đường CC2',
            'Hoàng Xuân Nhị',
            'Nguyễn Sơn',
            'Trường Chinh',
            'Đường CC3',
            'Hương lộ 3',
            'Nguyễn Súy',
            'Trương Vân Lĩnh',
            'Đường CC4',
            'Huỳnh Thiện Lộc',
            'Nguyễn Thái Học',
            'Trương Vĩnh Ký',
            'Đường CC5',
            'Huỳnh Văn Chính',
            'Nguyễn Thế Truyện',
            'Tự Do',
            'Đường CN 11',
            'Huỳnh Văn Một',
            'Nguyễn Trường Tộ',
            'Tự do 1',
            'Đường CN 13',
            'Ích Thiện',
            'Nguyễn Uẩn Sang',
            'Tự Quyết',
            'Đường CN 6',
            'Kênh 19 Tháng 5',
            'Nguyễn Văn Dưỡng',
            'Văn Cao',
            'Đường CN1',
            'Kênh Nước Đen',
            'Nguyễn Văn Huyên',
        ];
        foreach ($streets as $street) {
            try {
                Location::create([
                    'name' => $street,
                    'slug' => Str::slug($street),
                    'title' => $street,
                    'description' => $street,
                    // 'parent_id' => $TANPHU->id,
                    'parent_id' => 944,
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
