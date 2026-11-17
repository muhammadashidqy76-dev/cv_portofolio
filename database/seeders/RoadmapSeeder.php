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
        // 1. Role Master: IT Support & Network Engineering
        $itSupportRole = RoadmapRole::updateOrCreate(
            ['slug' => 'it-support'],
            [
                'name'          => 'IT Support & Systems',
                'tagline'       => 'Peta kurikulum penguasaan jaringan komputer, protokol inti internet, pemeliharaan hardware, dan studi kasus operasional IT support in-house.',
                'status'        => 'published',
                'display_order' => 1,
            ]
        );

        $networkNote = LearningLogEntry::where('category', LearningLogEntry::CATEGORY_IT_SUPPORT)->first();

        // 2. Daftar Kurikulum Standar Roadmap.sh (Network Engineer Track)
        $checkpoints = [
            // ── FASE 1: Dasar Jaringan & Terminologi (Network Fundamentals) ──
            [
                'phase_name'          => '01 // What are Networks & Basic Terminology',
                'title'               => 'What are Networks & Network Types',
                'description'         => 'Konsep fundamental interkoneksi sistem komputer untuk berbagi sumber daya. Perbedaan arsitektur LAN (Local Area Network), WAN, MAN, dan WLAN serta topologi fisik (Star, Mesh, Bus).',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'Roadmap.sh & Cisco Networking Academy',
                'external_url'        => 'https://www.cloudflare.com/learning/network-layer/what-is-a-computer-network/',
                'external_url_title'  => 'Cloudflare: What is a Computer Network?',
                'display_order'       => 1,
            ],
            [
                'phase_name'          => '01 // What are Networks & Basic Terminology',
                'title'               => 'Host, Packet, Frame, Bandwidth & Latency',
                'description'         => 'Terminologi transmisi data: Host (node ujung), Packet (unit layer 3), Frame (unit layer 2), perbandingan Bandwidth (kapasitas kanal) vs Throughput (kecepatan aktual), serta diagnosa Latency dan Packet Loss.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'Network Engineering Fundamentals',
                'external_url'        => 'https://www.cloudflare.com/learning/performance/glossary/what-is-latency/',
                'external_url_title'  => 'Cloudflare: What is Latency & Bandwidth?',
                'display_order'       => 2,
            ],
            [
                'phase_name'          => '01 // What are Networks & Basic Terminology',
                'title'               => 'MAC Address, IP Address & ARP Protocol',
                'description'         => 'Pengalamatan fisik Layer 2 (48-bit MAC Address burn-in) versus alamat logis Layer 3 (IP Address). Cara kerja Address Resolution Protocol (ARP) untuk memetakan IP address ke MAC address pada segmen LAN lokal.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'Cisco CCNA Foundation',
                'external_url'        => 'https://en.wikipedia.org/wiki/Address_Resolution_Protocol',
                'external_url_title'  => 'Wikipedia: Address Resolution Protocol (ARP)',
                'display_order'       => 3,
            ],
            [
                'phase_name'          => '01 // What are Networks & Basic Terminology',
                'title'               => 'Transmission Media Types (Copper UTP, Fiber & Wireless)',
                'description'         => 'Karakteristik media transmisi fisik: Kabel Twisted Pair UTP (Cat5e/Cat6/Cat6a) dengan konektor RJ-45 standar T568B, Kabel Fiber Optic (Single-mode vs Multi-mode), dan spektrum Wireless RF (2.4 GHz vs 5 GHz).',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'Buku Panduan Jaringan Komputer',
                'external_url'        => 'https://www.geeksforgeeks.org/types-of-transmission-media/',
                'external_url_title'  => 'GeeksforGeeks: Transmission Media in Computer Networks',
                'display_order'       => 4,
            ],

            // ── FASE 2: Core Protocols & Layer OSI / TCP-IP ──
            [
                'phase_name'          => '02 // OSI Model & Core Transport Protocols',
                'title'               => 'OSI 7-Layer vs TCP/IP Protocol Suite',
                'description'         => 'Pemahaman mendalam 7 layer model OSI (Physical hingga Application) dan 4 layer arsitektur TCP/IP internet. Konsep data encapsulation dan decapsulation (PDU: Bits, Frames, Packets, Segments, Data).',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'Cisco CCNA / RFC 1122',
                'external_url'        => 'https://www.cloudflare.com/learning/ddos/glossary/open-systems-interconnection-model-osi/',
                'external_url_title'  => 'Cloudflare Learning: OSI Model Explained',
                'display_order'       => 5,
            ],
            [
                'phase_name'          => '02 // OSI Model & Core Transport Protocols',
                'title'               => 'TCP (Transmission Control Protocol) & 3-Way Handshake',
                'description'         => 'Protokol layer transport berorientasi koneksi handal: proses 3-way handshake (SYN, SYN-ACK, ACK), flow control (sliding window), error recovery, dan mekanisme connection termination (FIN/ACK).',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'RFC 793 / Roadmap.sh',
                'external_url'        => 'https://www.geeksforgeeks.org/tcp-3-way-handshake-process/',
                'external_url_title'  => 'GeeksforGeeks: TCP 3-Way Handshake Process',
                'display_order'       => 6,
            ],
            [
                'phase_name'          => '02 // OSI Model & Core Transport Protocols',
                'title'               => 'UDP (User Datagram Protocol) & ICMP',
                'description'         => 'Protokol transport tanpa koneksi (connectionless) berkecepatan tinggi tanpa overhead retransmisi (DNS query, VoIP, video streaming). Pemanfaatan Internet Control Message Protocol (ICMP) untuk echo request/reply (ping & traceroute).',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'RFC 768 / RFC 792',
                'external_url'        => 'https://www.cloudflare.com/learning/ddos/glossary/user-datagram-protocol-udp/',
                'external_url_title'  => 'Cloudflare: User Datagram Protocol (UDP)',
                'display_order'       => 7,
            ],

            // ── FASE 3: Application Protocols (Layanan Jaringan Penting) ──
            [
                'phase_name'          => '03 // Application Protocols & Network Services',
                'title'               => 'DHCP (Dynamic Host Configuration Protocol)',
                'description'         => 'Alur kerja DORA process (Discover, Offer, Request, Acknowledge) untuk penugasan alamat IP otomatis, subnet mask, default gateway, lease time, dan konfigurasi IP reservation untuk server/printer.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'RFC 2131 / IT Helpdesk Standard',
                'external_url'        => 'https://www.cloudflare.com/learning/network-layer/what-is-dhcp/',
                'external_url_title'  => 'Cloudflare: What is DHCP?',
                'display_order'       => 8,
            ],
            [
                'phase_name'          => '03 // Application Protocols & Network Services',
                'title'               => 'DNS (Domain Name System) & Record Hierarchy',
                'description'         => 'Sistem resolusi nama domain hierarkis internet (Root, TLD, Authoritative, Recursive Resolver). Manajemen DNS Records esensial: A, AAAA, CNAME, MX, PTR, TXT serta flush DNS resolver cache.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'RFC 1035 / IT Support Foundation',
                'external_url'        => 'https://www.cloudflare.com/learning/dns/what-is-dns/',
                'external_url_title'  => 'Cloudflare: What is DNS & How it Works',
                'display_order'       => 9,
            ],
            [
                'phase_name'          => '03 // Application Protocols & Network Services',
                'title'               => 'HTTP, HTTPS & SSL/TLS Encryption',
                'description'         => 'Protokol pertukaran data web HyperText Transfer Protocol (Port 80) dan enkripsi TLS/SSL (Port 443). Sertifikat digital X.509, proses TLS handshake, dan verifikasi integritas data enkripsi.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'MDN Web Docs & Security Best Practices',
                'external_url'        => 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Overview',
                'external_url_title'  => 'MDN: An Overview of HTTP',
                'display_order'       => 10,
            ],
            [
                'phase_name'          => '03 // Application Protocols & Network Services',
                'title'               => 'SSH, Telnet & Remote Terminal Access',
                'description'         => 'Protokol remote command-line aman Secure Shell (Port 22) menggunakan public-key cryptography vs kelemahan protokol legacy Telnet (Port 23 unencrypted plain-text).',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'Linux & Network Administration',
                'external_url'        => 'https://www.digitalocean.com/community/tutorials/understanding-the-ssh-encryption-and-connection-process',
                'external_url_title'  => 'DigitalOcean: Understanding SSH Encryption',
                'display_order'       => 11,
            ],

            // ── FASE 4: Network Devices, Subnetting & Routing (CCNA Track) ──
            [
                'phase_name'          => '04 // Network Devices, Subnetting & Routing (CCNA Track)',
                'title'               => 'Network Devices: Hubs, Switches, Routers & Firewalls',
                'description'         => 'Fungsi komparatif perangkat: Hub (Layer 1 broadcast), Switch (Layer 2 MAC-learning table, VLAN isolation), Router (Layer 3 packet routing, WAN gateway), dan Firewall (packet filtering, stateful inspection).',
                'status'              => RoadmapCheckpoint::STATUS_IN_PROGRESS,
                'source_reference'    => 'Roadmap.sh Network Devices',
                'external_url'        => 'https://www.geeksforgeeks.org/network-devices-hub-repeater-bridge-switch-router-gateways/',
                'external_url_title'  => 'GeeksforGeeks: Network Devices Overview',
                'display_order'       => 12,
            ],
            [
                'phase_name'          => '04 // Network Devices, Subnetting & Routing (CCNA Track)',
                'title'               => 'IPv4 Subnetting & Variable Length Subnet Mask (VLSM)',
                'description'         => 'Perhitungan subnet mask notasi CIDR (/24 hingga /30), penentuan Network ID, Broadcast Address, jumlah host valid, serta teknik VLSM untuk efisiensi alokasi IP kantor.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'Cisco CCNA Subnetting Mastery',
                'external_url'        => 'https://www.practicalnetworking.net/stand-alone/subnetting-mastery/',
                'external_url_title'  => 'Practical Networking: Subnetting Mastery',
                'display_order'       => 13,
            ],
            [
                'phase_name'          => '04 // Network Devices, Subnetting & Routing (CCNA Track)',
                'title'               => 'Routing Basics: Static Routing, Default Routes & NAT',
                'description'         => 'Prinsip kerja Routing Table pada router, konfigurasi static route (ip route), default gateway (0.0.0.0/0), serta Network Address Translation (NAT/PAT) untuk mentranslasikan IP privat (RFC 1918) ke IP publik.',
                'status'              => RoadmapCheckpoint::STATUS_IN_PROGRESS,
                'source_reference'    => 'Cisco CCNA Routing Protocols',
                'external_url'        => 'https://www.cisco.com/c/en/us/support/docs/ip/routing-information-protocol-rip/13769-5.html',
                'external_url_title'  => 'Cisco: How Routing Works & IP Routing Overview',
                'display_order'       => 14,
            ],

            // ── FASE 5: Troubleshooting, Diagnostic CLI & In-House Projects ──
            [
                'phase_name'          => '05 // Troubleshooting CLI & In-House IT Support Projects',
                'title'               => 'Command-Line Network Diagnostics (CLI Tools)',
                'description'         => 'Penguasaan utility diagnosa jaringan esensial: ping (konektivitas ICMP), tracert/traceroute (hop routing), nslookup (verifikasi DNS), netstat (listening ports & socket connections), dan arp -a.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'IT Helpdesk & System Support Best Practice',
                'external_url'        => 'https://learn.microsoft.com/en-us/windows-server/administration/windows-commands/ping',
                'external_url_title'  => 'Microsoft Learn: Network Commands Reference',
                'display_order'       => 15,
            ],
            [
                'phase_name'          => '05 // Troubleshooting CLI & In-House IT Support Projects',
                'title'               => 'Studi Kasus: Pengkabelan LAN UTP Cat6 & Setup Workstation',
                'description'         => 'Pemasangan kabel UTP Cat6 dengan standar susunan pin T568B, terminasi ke modular keystone jack, integrasi ke patch panel dan switch gigabit unmanaged, serta pengujian kelayakan kabel dengan cable tester.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'Implementasi Praktik Mandiri & Lab Kantor',
                'external_url'        => 'https://www.truecable.com/blogs/cable-academy/t568a-vs-t568b',
                'external_url_title'  => 'TrueCable: T568A vs T568B Standards Guide',
                'display_order'       => 16,
            ],
            [
                'phase_name'          => '05 // Troubleshooting CLI & In-House IT Support Projects',
                'title'               => 'Studi Kasus: Network Printer Sharing & Centralized Access',
                'description'         => 'Konfigurasi IP reservasi statis pada printer jaringan kantor, sharing driver lintas PC Windows via Standard TCP/IP Port direct connection, serta manajemen antrean cetak dan service print spooler.',
                'status'              => RoadmapCheckpoint::STATUS_IN_PROGRESS,
                'source_reference'    => 'Implementasi Nyata IT Support Perkantoran',
                'external_url'        => 'https://support.microsoft.com/en-us/windows/share-your-network-printer-c9e158b8-4f34-c5f3-b128-8325a7457a41',
                'external_url_title'  => 'Microsoft Support: Share Your Network Printer in Windows',
                'display_order'       => 17,
            ],
            [
                'phase_name'          => '05 // Troubleshooting CLI & In-House IT Support Projects',
                'title'               => 'Studi Kasus: File Sharing SMB, NTFS Permissions & Backup 3-2-1',
                'description'         => 'Setup folder bersama (SMB Share) dengan kontrol otorisasi NTFS permissions per user/group, pemetaan Network Drive (Z:), serta implementasi kebijakan cadangan data 3-2-1 untuk perlindungan data operasional.',
                'status'              => RoadmapCheckpoint::STATUS_NOT_STARTED,
                'source_reference'    => 'SOP Keamanan Sistem Informasi Kantor',
                'external_url'        => 'https://www.veeam.com/blog/321-backup-rule.html',
                'external_url_title'  => 'Veeam: The 3-2-1 Backup Rule Explained',
                'display_order'       => 18,
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
