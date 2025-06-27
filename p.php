<main class="flex-1 p-6">
    <h2 class="py-6 font-bold text-xl">Formulir Pendaftaran Siswa Baru</h2>
    <p class="mb-4 font-semibold text-md text-red-600">Berikan tanda " - " untuk kolom yang tidak ingin diisi.</p>
    <form action="hasil_daftar_siswa.php" method="POST" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label for="full-name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" id="full-name" name="full_name" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
        </div>

        <div>
            <label for="nickname" class="block text-sm font-medium text-gray-700">Nama Panggilan</label>
            <input type="text" id="nickname" name="nickname" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
        </div>

        <div>
            <label for="birth" class="block text-sm font-medium text-gray-700">Tempat, Tanggal Lahir</label>
            <input type="text" id="birth" name="birth" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
        </div>

        <div>
            <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
            <select id="gender" name="gender" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
                <option value="" selected disabled>Pilih</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div>
            <label for="religion" class="block text-sm font-medium text-gray-700">Agama</label>
            <select id="religion" name="religion" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
                <option value="" selected disabled>Pilih</option>
                <option value="Islam">Islam</option>
                <option value="Kristen Protestan">Kristen Protestan</option>
                <option value="Kristen Katolik">Kristen Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
                <option value="Konghucu">Konghucu</option>
            </select>
        </div>

        <div>
            <label for="child_order" class="block text-sm font-medium text-gray-700">Anak Ke-</label>
            <input type="number" id="child_order" name="child_order" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
        </div>

        <div>
            <label for="siblings" class="block text-sm font-medium text-gray-700">Jumlah Saudara</label>
            <input type="number" id="siblings" name="siblings" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
        </div>

        <div>
            <label for="family_status" class="block text-sm font-medium text-gray-700">Status dalam Keluarga</label>
            <select name="family_status" id="family_status" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>

                <option value="" selected disabled>Pilih</option>
                <option value="anak kandung">Anak Kandung</option>
                <option value="anak tiri">Anak Tiri</option>
                <option value="anak angkat">Anak Angkat</option>
            </select>

        </div>

        <div>
            <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
            <textarea id="address" name="address" rows="3" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required></textarea>
        </div>

        <!-- Identitas Orang Tua / Wali -->
        <h3 class="text-lg font-semibold pt-6">Identitas Orang Tua / Wali</h3>

        <!-- Ayah -->
        <div>
            <label for="religion" class="block text-sm font-medium text-gray-700">Status Ayah</label>
            <select id="religion" name="religion" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                <option value="" selected disabled>Pilih</option>
                <option value="Islam">Kandung</option>
                <option value="Kristen Protestan">Tiri</option>
                <option value="Kristen Katolik">Angkat</option>
                <option value="Kristen Katolik">Wali</option>
            </select>
        </div>

        <div>
            <label for="father_name" class="block text-sm font-medium text-gray-700">Nama Ayah</label>
            <input type="text" id="father_name" name="father_name" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
        </div>

        <div>
            <label for="father_birthplace" class="block text-sm font-medium text-gray-700">Tempat Tanggal Lahir Ayah</label>
            <input type="text" id="father_birthplace" name="father_birthplace" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
        </div>

        <div>
            <label for="father_religion" class="block text-sm font-medium text-gray-700">Agama Ayah</label>
            <select id="father_religion" name="father_religion" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                <option value="" selected disabled>Pilih</option>
                <option value="Islam">Islam</option>
                <option value="Kristen Protestan">Kristen Protestan</option>
                <option value="Kristen Katolik">Kristen Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
                <option value="Konghucu">Konghucu</option>
            </select>
        </div>

        <div>
            <label for="father_job" class="block text-sm font-medium text-gray-700">Pekerjaan Ayah</label>
            <input type="text" id="father_job" name="father_job" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
        </div>

        <div>
            <label for="father_education" class="block text-sm font-medium text-gray-700">Pendidikan Ayah</label>
            <input type="text" id="father_education" name="father_education" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
        </div>

        <div>
            <label for="father_address" class="block text-sm font-medium text-gray-700">Alamat Ayah</label>
            <textarea id="father_address" name="father_address" rows="3" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required></textarea>
        </div>

        <div>
            <label for="father_phone" class="block text-sm font-medium text-gray-700">No. Telp Ayah</label>
            <input type="tel" id="father_phone" name="father_phone" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
        </div>

        <!-- Ibu -->
        <div>
            <label for="religion" class="block text-sm font-medium text-gray-700">Status Ibu</label>
            <select id="religion" name="religion" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                <option value="" selected disabled>Pilih</option>
                <option value="Islam">Kandung</option>
                <option value="Kristen Protestan">Tiri</option>
                <option value="Kristen Katolik">Angkat</option>
                <option value="Kristen Katolik">Wali</option>
            </select>

        </div>
        <div>
            <label for="mother_name" class="block text-sm font-medium text-gray-700">Nama Ibu</label>
            <input type="text" id="mother_name" name="mother_name" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
        </div>

        <div>
            <label for="mother_birthplace" class="block text-sm font-medium text-gray-700">Tempat Tanggal Lahir Ibu</label>
            <input type="text" id="mother_birthplace" name="mother_birthplace" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
        </div>

        <div>
            <label for="mother_religion" class="block text-sm font-medium text-gray-700">Agama Ibu</label>
            <select id="mother_religion" name="mother_religion" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
                <option value="" selected disabled>Pilih</option>
                <option value="Islam">Islam</option>
                <option value="Kristen Protestan">Kristen Protestan</option>
                <option value="Kristen Katolik">Kristen Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
                <option value="Konghucu">Konghucu</option>
            </select>
        </div>

        <div>
            <label for="mother_job" class="block text-sm font-medium text-gray-700">Pekerjaan Ibu</label>
            <input type="text" id="mother_job" name="mother_job" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
        </div>

        <div>
            <label for="mother_education" class="block text-sm font-medium text-gray-700">Pendidikan Ibu</label>
            <input type="text" id="mother_education" name="mother_education" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
        </div>

        <div>
            <label for="mother_address" class="block text-sm font-medium text-gray-700">Alamat Ibu</label>
            <textarea id="mother_address" name="mother_address" rows="3" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required></textarea>
        </div>

        <div>
            <label for="mother_phone" class="block text-sm font-medium text-gray-700">No. Telp Ibu</label>
            <input type="tel" id="mother_phone" name="mother_phone" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required />
        </div>


        <!-- Upload Berkas -->
        <div>
            <label for="kk" class="block text-sm font-medium text-gray-700">Kartu Keluarga</label>
            <input type="file" id="kk" name="kk" class="block w-full text-sm text-gray-700" required />
        </div>

        <div>
            <label for="akte" class="block text-sm font-medium text-gray-700">Akte Kelahiran</label>
            <input type="file" id="akte" name="akte" class="block w-full text-sm text-gray-700" required />
        </div>

        <div>
            <label for="ktp" class="block text-sm font-medium text-gray-700">KTP Orang Tua</label>
            <input type="file" id="ktp" name="ktp" class="block w-full text-sm text-gray-700" required />
        </div>

        <div>
            <label for="foto" class="block text-sm font-medium text-gray-700">Pas Foto (Background Merah/Biru)</label>
            <input type="file" id="foto" name="foto" class="block w-full text-sm text-gray-700" required />
        </div>

        <!-- Pembayaran -->
        <div class="border-t pt-4">
            <h3 class="font-semibold text-lg text-gray-800">Biaya Pendaftaran</h3>
            <p class="text-gray-700">Seragam Batik: <strong>Rp 190.000</strong></p>
            <p class="text-gray-700">SPP 1 Bulan: <strong>Rp 80.000</strong></p>
            <p class="text-gray-700">Perawatan Gedung: <strong>Rp 100.000</strong></p>
            <p class="text-gray-700">Total: <strong>Rp 370.000</strong></p>
            <p class="text-sm text-gray-600">Silakan transfer ke rekening <strong>BNI - 3657788876</strong> a.n. Yayasan Baitul Muhajirin dan unggah bukti transfer di bawah.</p>
            <label for="bukti_bayar" class="block text-sm font-medium text-gray-700 mt-2">Upload Bukti Pembayaran</label>
            <input type="file" id="bukti_bayar" name="bukti_bayar" class="block w-full text-sm text-gray-700" required />
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Kirim Pendaftaran</button>
    </form>
</main>