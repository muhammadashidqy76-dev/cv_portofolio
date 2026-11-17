<?php

namespace Database\Seeders;

use App\Models\RoadmapRole;
use App\Models\RoadmapCheckpoint;
use App\Models\LearningLogEntry;
use App\Models\Project;
use Illuminate\Database\Seeder;

class RoadmapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat / update Role IT Support & Systems
        $itSupportRole = RoadmapRole::updateOrCreate(
            ['slug' => 'it-support'],
            [
                'name'          => 'IT Support & Systems',
                'tagline'       => 'Peta kurikulum pembelajaran terapan, fondasi jaringan komputer (CCNA Introduction), pemeliharaan perangkat keras & sistem operasi, serta implementasi in-house IT support perkantoran.',
                'status'        => 'published',
                'display_order' => 1,
            ]
        );

        // Ambil note IT Support jika ada untuk ditautkan
        $networkNote = LearningLogEntry::where('category', LearningLogEntry::CATEGORY_IT_SUPPORT)->first();

        // 2. Data Checkpoints terstruktur per fase
        $checkpoints = [
            // ── Fase 1: Jaringan Komputer (CCNA Foundation) ──
            [
                'phase_name'       => '01 // Computer Networking Fundamentals (CCNA Prep & Basic)',
                'title'            => 'Model OSI & TCP/IP Protocol Suite',
                'description'      => 'Memahami fungsi 7 layer OSI dan 4 layer TCP/IP, proses enkapsulasi dan dekapsulasi paket data, serta perbedaan karakteristik protokol transmisi TCP (handshake) dan UDP.',
                'status'           => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference' => 'Cisco Networking Academy (Introduction to Networks)',
                'display_order'    => 1,
            ],
            [
                'phase_name'       => '01 // Computer Networking Fundamentals (CCNA Prep & Basic)',
                'title'            => 'IPv4 Addressing, Subnetting & Default Gateway',
                'description'      => 'Perhitungan subnet mask IPv4 (notasi CIDR /24 hingga /29), pemisahan Network ID dan Broadcast Address, penentuan usable host, serta penetapan IP statis dan gateway pada workstation.',
                'status'           => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference' => 'Cisco Networking Academy & Modul Latihan Subnetting',
                'display_order'    => 2,
            ],
            [
                'phase_name'       => '01 // Computer Networking Fundamentals (CCNA Prep & Basic)',
                'title'            => 'Layanan Inti Jaringan: DHCP & DNS',
                'description'      => 'Prinsip kerja DORA process pada alokasi IP otomatis oleh DHCP Server, serta resolusi nama domain ke IP address via DNS Record (A, CNAME, PTR) untuk kelancaran koneksi klien.',
                'status'           => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference' => 'Buku Jaringan Komputer Dasar & RFC Standar',
                'display_order'    => 3,
            ],
            [
                'phase_name'       => '01 // Computer Networking Fundamentals (CCNA Prep & Basic)',
                'title'            => 'Switching, Routing SOHO & Wireless Access Point',
                'description'      => 'Prinsip kerja bridging switch layer-2, pemisahan collision domain, konfigurasi dasar router SOHO (NAT/Port Forwarding), serta pengamanan SSID WiFi dengan enkripsi WPA2/WPA3.',
                'status'           => RoadmapCheckpoint::STATUS_IN_PROGRESS,
                'source_reference' => 'Cisco Networking Academy (CCNA Free Intro)',
                'display_order'    => 4,
            ],

            // ── Fase 2: Hardware & OS Troubleshooting ──
            [
                'phase_name'       => '02 // Client Hardware & Operating System Troubleshooting',
                'title'            => 'Perakitan Komputer Kantor & Diagnosa Kegagalan Hardware',
                'description'      => 'Troubleshooting gejala kegagalan POST (beep code sequence), pengetesan kompatibilitas RAM multi-channel, pengujian kestabilan Power Supply (PSU), serta pemasangan storage NVMe SSD.',
                'status'           => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference' => 'Standar Praktik Teknisi Komputer & Hardware',
                'display_order'    => 5,
            ],
            [
                'phase_name'       => '02 // Client Hardware & Operating System Troubleshooting',
                'title'            => 'Instalasi, Partisi & Pemulihan Windows 10/11 Desktop',
                'description'      => 'Instalasi sistem operasi modern berbasis UEFI/GPT, pengelolaan partisi via command diskpart, update dan instalasi driver vendor resmi, serta penanganan error Blue Screen (BSOD).',
                'status'           => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference' => 'Panduan Helpdesk IT Desktop & Sistem Operasi',
                'display_order'    => 6,
            ],
            [
                'phase_name'       => '02 // Client Hardware & Operating System Troubleshooting',
                'title'            => 'Command Line Utilities untuk Network Troubleshooting',
                'description'      => 'Pemanfaatan utilitas CLI esensial (ping, tracert, nslookup, netstat, arp, ipconfig /flushdns /renew) untuk mengisolasi titik putus konektivitas jaringan secara cepat.',
                'status'           => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference' => 'Buku Panduan Praktis Network Diagnostics',
                'display_order'    => 7,
            ],
            [
                'phase_name'       => '02 // Client Hardware & Operating System Troubleshooting',
                'title'            => 'Remote Assistance & Helpdesk Ticketing Workflow',
                'description'      => 'Penerapan protokol bantuan jarak jauh (RDP, AnyDesk, TeamViewer) secara aman untuk pemecahan masalah end-user, serta pencatatan dokumentasi riwayat tiket insiden sesuai target SLA.',
                'status'           => RoadmapCheckpoint::STATUS_IN_PROGRESS,
                'source_reference' => 'SOP Layanan IT Helpdesk & Service Desk Support',
                'display_order'    => 8,
            ],

            // ── Fase 3: In-House Case Study & Proyek Kantor ──
            [
                'phase_name'       => '03 // In-House Applied Projects & Office Infrastructure',
                'title'            => 'Studi Kasus: Pengkabelan LAN & Setup Multi-PC Workstation',
                'description'      => 'Perakitan kabel UTP Cat6 dengan susunan standar T568B, terminasi ke modular jack/patch panel, integrasi ke switch gigabit unmanaged, dan verifikasi fisik dengan LAN cable tester.',
                'status'           => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference' => 'Implementasi Lapangan / Lab Praktik Mandiri',
                'display_order'    => 9,
            ],
            [
                'phase_name'       => '03 // In-House Applied Projects & Office Infrastructure',
                'title'            => 'Studi Kasus: Network Printer Sharing & Centralized Access',
                'description'      => 'Konfigurasi reservasi IP statis pada printer jaringan kantor, sharing driver lintas PC Windows via Standard TCP/IP Port, serta manajemen permission antrean cetak (print spooler).',
                'status'           => RoadmapCheckpoint::STATUS_IN_PROGRESS,
                'source_reference' => 'Implementasi Infrastruktur Kantor In-House',
                'display_order'    => 10,
            ],
            [
                'phase_name'       => '03 // In-House Applied Projects & Office Infrastructure',
                'title'            => 'Penyimpanan Berbagi (SMB Share) & Kebijakan Backup Data 3-2-1',
                'description'      => 'Konfigurasi shared folder jaringan dengan otorisasi hak akses user (NTFS permissions) serta penerapan strategi proteksi cadangan data berkala 3-2-1 untuk arsip dokumen krusial.',
                'status'           => RoadmapCheckpoint::STATUS_NOT_STARTED,
                'source_reference' => 'Best Practice Keamanan Informasi & Disaster Recovery',
                'display_order'    => 11,
            ],
        ];

        // Kosongkan checkpoint lama milik role ini jika ada (idempotent seeder)
        RoadmapCheckpoint::where('roadmap_role_id', $itSupportRole->id)->delete();

        foreach ($checkpoints as $data) {
            $data['roadmap_role_id'] = $itSupportRole->id;
            // Tautkan note IT Support ke checkpoint jika ada
            if ($networkNote && str_contains(strtolower($data['title']), 'network')) {
                $data['learning_log_entry_id'] = $networkNote->id;
            }
            RoadmapCheckpoint::create($data);
        }
    }
}
