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
        // 1. Role Master: IT Support & Systems (Kurikulum CCNA + Terapan Lapangan)
        $itSupportRole = RoadmapRole::updateOrCreate(
            ['slug' => 'it-support'],
            [
                'name'          => 'IT Support & Systems',
                'tagline'       => 'Peta kurikulum penguasaan jaringan komputer berbasis standar Cisco CCNA, pemeliharaan hardware/OS, serta studi kasus infrastruktur IT support in-house.',
                'status'        => 'published',
                'display_order' => 1,
            ]
        );

        $networkNote = LearningLogEntry::where('category', LearningLogEntry::CATEGORY_IT_SUPPORT)->first();

        // 2. Daftar Kurikulum 6 Fase (17 Checkpoints) Berdasarkan Cisco CCNA ITN & Praktik IT Support
        $checkpoints = [
            // ── FASE 1: Network Concepts & Initial Device Setup (Cisco ITN Modul 1 & 2) ──
            [
                'phase_name'          => '01 // Network Concepts & Initial Device Setup',
                'title'               => 'Networking Today & Host Roles',
                'description'         => 'Konsep fundamental jaringan komputer, peran host (Client & Server), klasifikasi jaringan (LAN, WAN, WLAN), topologi fisik & logis (Star, Mesh, Bus), serta fungsi perangkat jaringan dasar.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 1',
                'external_url'        => null,
                'external_url_title'  => null,
                'display_order'       => 1,
            ],
            [
                'phase_name'          => '01 // Network Concepts & Initial Device Setup',
                'title'               => 'Basic Switch & End Device Configuration',
                'description'         => 'Navigasi antarmuka Cisco IOS CLI (User EXEC, Privileged EXEC, Global Config), konfigurasi hostname, password konsol, password privilege secret, banner MOTD, dan konfigurasi SVI Management IP pada Switch Layer 2.',
                'status'              => RoadmapCheckpoint::STATUS_IN_PROGRESS,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 2',
                'external_url'        => null,
                'external_url_title'  => null,
                'display_order'       => 2,
            ],

            // ── FASE 2: Protocols, Architecture Models & Physical Media (Cisco ITN Modul 3 – 7) ──
            [
                'phase_name'          => '02 // Protocols, Models & Physical Media',
                'title'               => 'Protocol Suites & Reference Models (OSI vs TCP/IP)',
                'description'         => 'Pembedahan 7 layer OSI model vs 4 layer TCP/IP suite, standarisasi protokol internet (IETF/IEEE), serta alur enkapsulasi dan dekapsulasi data (PDU: Data, Segment, Packet, Frame, Bits).',
                'status'              => RoadmapCheckpoint::STATUS_NOT_STARTED,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 3',
                'external_url'        => null,
                'external_url_title'  => null,
                'display_order'       => 3,
            ],
            [
                'phase_name'          => '02 // Protocols, Models & Physical Media',
                'title'               => 'Physical Layer & Transmission Media (Copper UTP)',
                'description'         => 'Karakteristik kabel tembaga Twisted Pair (UTP Cat5e/Cat6/Cat6a), susunan pin standar T568A vs T568B, konektor RJ-45, serta pemahaman dasar media Fiber Optic dan frekuensi Wireless RF.',
                'status'              => RoadmapCheckpoint::STATUS_NOT_STARTED,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 4',
                'external_url'        => null,
                'external_url_title'  => null,
                'display_order'       => 4,
            ],
            [
                'phase_name'          => '02 // Protocols, Models & Physical Media',
                'title'               => 'Data Link Layer, Ethernet Switching & MAC Address',
                'description'         => 'Struktur frame Ethernet, pengalamatan fisik MAC Address (48-bit hex), mekanisme kerja switch membangun MAC Address Table, dan metode forwarding frame (Store-and-Forward vs Cut-Through).',
                'status'              => RoadmapCheckpoint::STATUS_NOT_STARTED,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 6 & 7',
                'external_url'        => null,
                'external_url_title'  => null,
                'display_order'       => 5,
            ],

            // ── FASE 3: Network Layer, IPv4 Addressing & Subnetting (Cisco ITN Modul 8 – 12) ──
            [
                'phase_name'          => '03 // IP Addressing & Subnetting',
                'title'               => 'IPv4 Addressing, CIDR & Subnetting Praktis',
                'description'         => 'Struktur alamat IPv4 (32-bit), pembagian network portion vs host portion, perhitungan subnet mask notasi CIDR (/24 hingga /29), penentuan Network ID, Broadcast Address, dan usable host range.',
                'status'              => RoadmapCheckpoint::STATUS_NOT_STARTED,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 11',
                'external_url'        => null,
                'external_url_title'  => null,
                'display_order'       => 6,
            ],
            [
                'phase_name'          => '03 // IP Addressing & Subnetting',
                'title'               => 'Address Resolution Protocol (ARP)',
                'description'         => 'Mekanisme resolusi pemetaan IP address (Layer 3) ke MAC address fisik (Layer 2), proses pengiriman broadcast ARP Request dan unicast ARP Reply, serta pengecekan tabel ARP cache (arp -a).',
                'status'              => RoadmapCheckpoint::STATUS_NOT_STARTED,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 9',
                'external_url'        => null,
                'external_url_title'  => null,
                'display_order'       => 7,
            ],
            [
                'phase_name'          => '03 // IP Addressing & Subnetting',
                'title'               => 'Pengenalan IPv6 Addressing Basics',
                'description'         => 'Keterbatasan ruang alamat IPv4 dan kebutuhan transisi ke IPv6 (128-bit hex), perbedaan jenis alamat Global Unicast Address (GUA) dan Link-Local Address (LLA) untuk konektivitas modern.',
                'status'              => RoadmapCheckpoint::STATUS_NOT_STARTED,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 12',
                'external_url'        => null,
                'external_url_title'  => null,
                'display_order'       => 8,
            ],

            // ── FASE 4: Transport, Application Services & Network Diagnostics (Cisco ITN Modul 13 – 17) ──
            [
                'phase_name'          => '04 // Transport, Application & Network Tools',
                'title'               => 'Transport Layer: TCP vs UDP & Port Numbers',
                'description'         => 'Perbedaan karakteristik TCP (reliable, connection-oriented, 3-way handshake SYN/ACK, error recovery) vs UDP (kecepatan tinggi, connectionless) serta nomor port standar layanan internet (Port 1–1023).',
                'status'              => RoadmapCheckpoint::STATUS_NOT_STARTED,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 14',
                'external_url'        => null,
                'external_url_title'  => null,
                'display_order'       => 9,
            ],
            [
                'phase_name'          => '04 // Transport, Application & Network Tools',
                'title'               => 'Core Application Services: DHCP & DNS',
                'description'         => 'Mekanisme DORA process pada DHCP (Discover, Offer, Request, Acknowledge) untuk distribusi alamat IP dinamis, serta hierarki Domain Name System (DNS) dalam memetakan nama domain ke IP.',
                'status'              => RoadmapCheckpoint::STATUS_NOT_STARTED,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 15',
                'external_url'        => null,
                'external_url_title'  => null,
                'display_order'       => 10,
            ],
            [
                'phase_name'          => '04 // Transport, Application & Network Tools',
                'title'               => 'Command-Line Network Diagnostics & ICMP Utilities',
                'description'         => 'Pemanfaatan utilitas diagnosa CLI esensial: pengujian echo ICMP (ping), penelusuran rute hop (tracert/traceroute), query catatan DNS (nslookup), dan pemantauan socket port aktif (netstat).',
                'status'              => RoadmapCheckpoint::STATUS_NOT_STARTED,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 13 & 17',
                'external_url'        => null,
                'external_url_title'  => null,
                'display_order'       => 11,
            ],

            // ── FASE 5: Client Hardware & OS Administration (Spesifik IT Support) ──
            [
                'phase_name'          => '05 // Client Hardware & OS Troubleshooting',
                'title'               => 'Perakitan Komputer Kantor & Diagnosa Kegagalan Hardware',
                'description'         => 'Troubleshooting gejala kegagalan POST (beep codes/LED debugger), pengetesan kompatibilitas RAM multi-channel, pengujian kestabilan Power Supply (PSU), serta pemasangan storage NVMe SSD.',
                'status'              => RoadmapCheckpoint::STATUS_NOT_STARTED,
                'source_reference'    => 'Panduan Praktisi Teknisi Komputer',
                'external_url'        => null,
                'external_url_title'  => null,
                'display_order'       => 12,
            ],
            [
                'phase_name'          => '05 // Client Hardware & OS Troubleshooting',
                'title'               => 'Instalasi, Partisi & Pemulihan Windows 10/11 Desktop',
                'description'         => 'Instalasi sistem operasi modern berbasis UEFI/GPT, pengelolaan partisi via command diskpart, update dan instalasi driver vendor resmi, serta penanganan error Blue Screen (BSOD).',
                'status'              => RoadmapCheckpoint::STATUS_NOT_STARTED,
                'source_reference'    => 'Standar Helpdesk IT Desktop & OS',
                'external_url'        => null,
                'external_url_title'  => null,
                'display_order'       => 13,
            ],
            [
                'phase_name'          => '05 // Client Hardware & OS Troubleshooting',
                'title'               => 'Remote Assistance & Helpdesk Ticketing Workflow',
                'description'         => 'Penerapan protokol bantuan jarak jauh (RDP, AnyDesk, TeamViewer) secara aman untuk pemecahan masalah end-user, serta pencatatan dokumentasi riwayat tiket insiden sesuai target SLA.',
                'status'              => RoadmapCheckpoint::STATUS_NOT_STARTED,
                'source_reference'    => 'SOP Layanan IT Helpdesk & Service Desk',
                'external_url'        => null,
                'external_url_title'  => null,
                'display_order'       => 14,
            ],

            // ── FASE 6: In-House Office Infrastructure Projects (Studi Kasus Proyek Riil) ──
            [
                'phase_name'          => '06 // In-House Office Infrastructure Projects',
                'title'               => 'Studi Kasus: Pengkabelan LAN Cat6 & Setup Workstation',
                'description'         => 'Perakitan kabel UTP Cat6 dengan susunan standar T568B, terminasi ke modular jack/patch panel, integrasi ke switch gigabit unmanaged, dan verifikasi fisik dengan LAN cable tester.',
                'status'              => RoadmapCheckpoint::STATUS_NOT_STARTED,
                'source_reference'    => 'Implementasi Lapangan / Lab Praktik',
                'external_url'        => null,
                'external_url_title'  => null,
                'display_order'       => 15,
            ],
            [
                'phase_name'          => '06 // In-House Office Infrastructure Projects',
                'title'               => 'Studi Kasus: Network Printer Sharing & Centralized Access',
                'description'         => 'Konfigurasi reserved IP statis pada printer jaringan kantor, sharing driver lintas PC Windows via Standard TCP/IP Port, serta manajemen antrean cetak (print spooler service).',
                'status'              => RoadmapCheckpoint::STATUS_NOT_STARTED,
                'source_reference'    => 'Implementasi Infrastruktur Kantor',
                'external_url'        => null,
                'external_url_title'  => null,
                'display_order'       => 16,
            ],
            [
                'phase_name'          => '06 // In-House Office Infrastructure Projects',
                'title'               => 'Studi Kasus: Penyimpanan Berbagi (SMB Share) & Kebijakan Backup Data 3-2-1',
                'description'         => 'Konfigurasi shared folder jaringan dengan otorisasi hak akses user (NTFS permissions) serta penerapan strategi proteksi cadangan data berkala 3-2-1 untuk arsip dokumen krusial.',
                'status'              => RoadmapCheckpoint::STATUS_NOT_STARTED,
                'source_reference'    => 'Best Practice Keamanan Informasi',
                'external_url'        => null,
                'external_url_title'  => null,
                'display_order'       => 17,
            ],
        ];

        // Reset checkpoints lama role ini (idempotent seeder)
        RoadmapCheckpoint::where('roadmap_role_id', $itSupportRole->id)->delete();

        foreach ($checkpoints as $data) {
            $data['roadmap_role_id'] = $itSupportRole->id;
            // Tautkan note internal jika relevan dengan DNS / DHCP
            if ($networkNote && (str_contains(strtolower($data['title']), 'dhcp') || str_contains(strtolower($data['title']), 'dns'))) {
                $data['learning_log_entry_id'] = $networkNote->id;
            }
            RoadmapCheckpoint::create($data);
        }
    }
}
