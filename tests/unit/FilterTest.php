<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\MotorcycleModel;

class FilterTest extends CIUnitTestCase
{
    protected $motorModel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->motorModel = new MotorcycleModel();
    }

    /**
     * Test filter by search keyword
     */
    public function testSearchFilter()
    {
        $search = 'Honda';
        $result = $this->motorModel->where('status', 'tersedia')
            ->groupStart()
            ->like('plat_nomor', $search)
            ->orLike('merk', $search)
            ->orLike('tipe', $search)
            ->orLike('warna', $search)
            ->groupEnd()
            ->findAll();

        $this->assertIsArray($result);
    }

    /**
     * Test filter by merk
     */
    public function testMerkFilter()
    {
        $merk = 'Honda';
        $result = $this->motorModel->where('status', 'tersedia')
            ->where('merk', $merk)
            ->findAll();

        $this->assertIsArray($result);
        foreach ($result as $motor) {
            $this->assertEquals($motor['merk'], $merk);
        }
    }

    /**
     * Test filter by warna
     */
    public function testWarnaFilter()
    {
        $warna = 'Merah';
        $result = $this->motorModel->where('status', 'tersedia')
            ->where('warna', $warna)
            ->findAll();

        $this->assertIsArray($result);
    }

    /**
     * Test filter by tahun
     */
    public function testTahunFilter()
    {
        $tahun = 2023;
        $result = $this->motorModel->where('status', 'tersedia')
            ->where('tahun', $tahun)
            ->findAll();

        $this->assertIsArray($result);
    }

    /**
     * Test filter by price range
     */
    public function testPriceRangeFilter()
    {
        $hargaMin = 10000000;
        $hargaMax = 50000000;
        
        $result = $this->motorModel->where('status', 'tersedia')
            ->where('harga_jual >=', $hargaMin)
            ->where('harga_jual <=', $hargaMax)
            ->findAll();

        $this->assertIsArray($result);
        foreach ($result as $motor) {
            $this->assertGreaterThanOrEqual($hargaMin, $motor['harga_jual']);
            $this->assertLessThanOrEqual($hargaMax, $motor['harga_jual']);
        }
    }

    /**
     * Test filter by status
     */
    public function testStatusFilter()
    {
        $status = 'tersedia';
        $result = $this->motorModel->where('status', $status)->findAll();

        $this->assertIsArray($result);
        foreach ($result as $motor) {
            $this->assertEquals($motor['status'], $status);
        }
    }

    /**
     * Test combined filters
     */
    public function testCombinedFilters()
    {
        $merk = 'Honda';
        $tahun = 2023;
        $hargaMin = 10000000;
        
        $result = $this->motorModel->where('status', 'tersedia')
            ->where('merk', $merk)
            ->where('tahun', $tahun)
            ->where('harga_jual >=', $hargaMin)
            ->findAll();

        $this->assertIsArray($result);
    }
}
