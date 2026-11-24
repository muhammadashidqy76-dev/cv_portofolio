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
     * Run the database seeds for both IT Support and Cloud Engineer (AWS).
     */
    public function run(): void
    {
        $networkNote = LearningLogEntry::where('category', 'it_support')->first();
        $cloudNote   = LearningLogEntry::where('category', 'cloud_engineering')->first();
        $cloudProject = Project::where('slug', 'like', '%cloud%')->orWhere('slug', 'like', '%api%')->first();

        // ═══════════════════════════════════════════════════════════════════════════
        // 1. ROLE: IT Support & Systems Specialist
        // ═══════════════════════════════════════════════════════════════════════════
        $itSupportRole = RoadmapRole::updateOrCreate(
            ['slug' => 'it-support'],
            [
                'name'          => 'IT Support & Systems',
                'tagline'       => 'Peta kurikulum penguasaan jaringan komputer berbasis standar Cisco CCNA, pemeliharaan hardware/OS, serta studi kasus infrastruktur IT support in-house.',
                'status'        => 'published',
                'display_order' => 1,
            ]
        );

        $itCheckpoints = [
            // ── FASE 1: Network Concepts & Initial Device Setup ──
            [
                'phase_name'          => '01 // Network Concepts & Initial Device Setup',
                'title'               => 'Networking Today & Host Roles',
                'description'         => 'Konsep fundamental jaringan komputer, peran host (Client & Server), klasifikasi jaringan (LAN, WAN, WLAN), topologi fisik & logis (Star, Mesh, Bus), serta fungsi perangkat jaringan dasar.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 1',
                'display_order'       => 1,
            ],
            [
                'phase_name'          => '01 // Network Concepts & Initial Device Setup',
                'title'               => 'Basic Switch & End Device Configuration',
                'description'         => 'Navigasi antarmuka Cisco IOS CLI (User EXEC, Privileged EXEC, Global Config), konfigurasi hostname, password konsol, password privilege secret, banner MOTD, dan konfigurasi SVI Management IP pada Switch Layer 2.',
                'status'              => RoadmapCheckpoint::STATUS_IN_PROGRESS,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 2',
                'display_order'       => 2,
            ],

            // ── FASE 2: Protocols, Models & Physical Media ──
            [
                'phase_name'          => '02 // Protocols, Models & Physical Media',
                'title'               => 'Protocol Suites & Reference Models (OSI vs TCP/IP)',
                'description'         => 'Pembedahan 7 layer OSI model vs 4 layer TCP/IP suite, standarisasi protokol internet (IETF/IEEE), serta alur enkapsulasi dan dekapsulasi data (PDU: Data, Segment, Packet, Frame, Bits).',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 3',
                'display_order'       => 3,
            ],
            [
                'phase_name'          => '02 // Protocols, Models & Physical Media',
                'title'               => 'Physical Layer & Transmission Media (Copper UTP)',
                'description'         => 'Karakteristik kabel tembaga Twisted Pair (UTP Cat5e/Cat6/Cat6a), susunan pin standar T568A vs T568B, konektor RJ-45, serta pemahaman dasar media Fiber Optic dan frekuensi Wireless RF.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 4',
                'display_order'       => 4,
            ],
            [
                'phase_name'          => '02 // Protocols, Models & Physical Media',
                'title'               => 'Data Link Layer & Ethernet Framing',
                'description'         => 'Format bingkai Ethernet II (Preamble, SFD, Mac Destination, Mac Source, EtherType, Payload, FCS), mekanisme CSMA/CD vs CSMA/CA, dan peran MAC Address 48-bit.',
                'status'              => RoadmapCheckpoint::STATUS_IN_PROGRESS,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 5 & 6',
                'display_order'       => 5,
            ],

            // ── FASE 3: IP Addressing & Subnetting ──
            [
                'phase_name'          => '03 // IP Addressing & Subnetting',
                'title'               => 'IPv4 Addressing Structure & Subnet Masks',
                'description'         => 'Struktur alamat IPv4 32-bit dalam format notasi desimal bertitik, kalkulasi konversi biner ke desimal, Network Portion vs Host Portion, dan fungsi Subnet Mask.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 11',
                'display_order'       => 6,
            ],
            [
                'phase_name'          => '03 // IP Addressing & Subnetting',
                'title'               => 'FLSM & VLSM Subnetting Mastery',
                'description'         => 'Perhitungan pemisahan subnet berbasis FLSM (Fixed Length Subnet Mask) dan VLSM (Variable Length Subnet Mask) untuk efisiensi pengalamatan segmen departemen kantor.',
                'status'              => RoadmapCheckpoint::STATUS_IN_PROGRESS,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 11',
                'display_order'       => 7,
            ],

            // ── FASE 4: Transport, Application & Network Tools ──
            [
                'phase_name'          => '04 // Transport, Application & Network Tools',
                'title'               => 'Transport Layer: TCP vs UDP Deep-Dive',
                'description'         => 'Perbandingan TCP (Connection-oriented, 3-way Handshake SYN-SYN/ACK-ACK, Flow Control) vs UDP (Connectionless, low-overhead untuk VoIP/Streaming).',
                'status'              => RoadmapCheckpoint::STATUS_IN_PROGRESS,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 14',
                'display_order'       => 8,
            ],
            [
                'phase_name'          => '04 // Transport, Application & Network Tools',
                'title'               => 'Application Layer Protocols: DNS & DHCP Services',
                'description'         => 'Mekanisme alur resolusi nama domain DNS (A, CNAME, MX, TXT) serta proses alokasi otomatis IP client via DHCP 4-Way DORA (Discover, Offer, Request, Acknowledge).',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'Cisco Networking Academy - ITN Module 15',
                'display_order'       => 9,
            ],

            // ── FASE 5: Client Hardware & OS Troubleshooting ──
            [
                'phase_name'          => '05 // Client Hardware & OS Troubleshooting',
                'title'               => 'Hardware Diagnostics, POST Codes & RAM/Storage Maintenance',
                'description'         => 'Prosedur isolasi kegagalan POST (Power-On Self-Test), interpretasi audio beep codes, analisis kesehatan SMART SSD/HDD, serta manajemen thermal pasta CPU & airflow casing PC.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'CompTIA A+ Core 1 Practice Guide',
                'display_order'       => 10,
            ],
            [
                'phase_name'          => '05 // Client Hardware & OS Troubleshooting',
                'title'               => 'Windows OS & Linux Client Troubleshooting Suite',
                'description'         => 'Diagnostik BSOD (Blue Screen of Death) Windows via Minidump / Event Viewer, perbaikan system image via DISM/SFC, recovery bootloader, serta instalasi dan administrasi Linux desktop.',
                'status'              => RoadmapCheckpoint::STATUS_IN_PROGRESS,
                'source_reference'    => 'CompTIA A+ Core 2 Practice Guide',
                'display_order'       => 11,
            ],

            // ── FASE 6: In-House Office Infrastructure Projects ──
            [
                'phase_name'          => '06 // In-House Office Infrastructure Projects',
                'title'               => 'Studi Kasus: Pengkabelan LAN Cat6 & Setup Workstation',
                'description'         => 'Perakitan kabel UTP Cat6 dengan susunan standar T568B, terminasi ke modular jack/patch panel, integrasi ke switch gigabit unmanaged, dan verifikasi fisik dengan LAN cable tester.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'Implementasi Lapangan / Lab Praktik',
                'display_order'       => 12,
            ],
            [
                'phase_name'          => '06 // In-House Office Infrastructure Projects',
                'title'               => 'Studi Kasus: Network Printer Sharing & Centralized Access',
                'description'         => 'Konfigurasi reserved IP statis pada printer jaringan kantor, sharing driver lintas PC Windows via Standard TCP/IP Port, serta manajemen antrean cetak (print spooler service).',
                'status'              => RoadmapCheckpoint::STATUS_IN_PROGRESS,
                'source_reference'    => 'Implementasi Infrastruktur Kantor',
                'display_order'       => 13,
            ],
            [
                'phase_name'          => '06 // In-House Office Infrastructure Projects',
                'title'               => 'Studi Kasus: Penyimpanan Berbagi (SMB Share) & Kebijakan Backup 3-2-1',
                'description'         => 'Konfigurasi shared folder jaringan dengan otorisasi hak akses user (NTFS permissions) serta penerapan strategi proteksi cadangan data berkala 3-2-1 untuk arsip dokumen kantor.',
                'status'              => RoadmapCheckpoint::STATUS_IN_PROGRESS,
                'source_reference'    => 'Best Practice Keamanan Informasi',
                'display_order'       => 14,
            ],
        ];

        RoadmapCheckpoint::where('roadmap_role_id', $itSupportRole->id)->delete();
        foreach ($itCheckpoints as $item) {
            $item['roadmap_role_id'] = $itSupportRole->id;
            if ($networkNote && (str_contains(strtolower($item['title']), 'dns') || str_contains(strtolower($item['title']), 'dhcp'))) {
                $item['learning_log_entry_id'] = $networkNote->id;
            }
            RoadmapCheckpoint::create($item);
        }

        // ═══════════════════════════════════════════════════════════════════════════
        // 2. ROLE: Cloud Engineer (AWS & Linux Infrastructure)
        // ═══════════════════════════════════════════════════════════════════════════
        $cloudRole = RoadmapRole::updateOrCreate(
            ['slug' => 'cloud-engineer'],
            [
                'name'          => 'Cloud Engineer (AWS)',
                'tagline'       => 'Peta kurikulum penguasaan arsitektur komputasi awan AWS, administrasi Linux server, containerization Docker, serta otomatisasi deployment cloud.',
                'status'        => 'published',
                'display_order' => 2,
            ]
        );

        $cloudCheckpoints = [
            // ── FASE 1: Linux System Administration & Shell Foundations ──
            [
                'phase_name'          => '01 // Linux Administration & Shell Essentials',
                'title'               => 'Linux CLI, Filesystem Hierarchy & User Permissions',
                'description'         => 'Standar hierarki filesystem Linux (/etc, /var, /opt, /home), manajemen user/group, permission file chmod (numeric/symbolic) & chown, serta navigasi terminal shell Bash.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'Linux Professional Institute (LPIC-1)',
                'display_order'       => 1,
            ],
            [
                'phase_name'          => '01 // Linux Administration & Shell Essentials',
                'title'               => 'Systemd Services, Process Management & Cron Automation',
                'description'         => 'Manajemen service daemons via systemctl (start, stop, enable, status), monitoring resource proses sistem (top, htop, ps aux, kill), serta penjadwalan backup otomatis via crontab.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'LPIC-1 / Linux System Administration',
                'display_order'       => 2,
            ],
            [
                'phase_name'          => '01 // Linux Administration & Shell Essentials',
                'title'               => 'SSH Hardening, Key Authentication & Firewall UFW',
                'description'         => 'Konfigurasi secure shell (SSH) dengan autentikasi RSA/Ed25519 key, menonaktifkan password authentication & root login, serta filtering lalu lintas masuk menggunakan firewall UFW / iptables.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'Linux Security Hardening Guide',
                'display_order'       => 3,
            ],

            // ── FASE 2: AWS Core Compute & Storage Services ──
            [
                'phase_name'          => '02 // AWS Core Compute & Storage Services',
                'title'               => 'Amazon EC2 Provisioning & Security Groups',
                'description'         => 'Peluncuran instance virtual server Amazon EC2 (Ubuntu/Amazon Linux), konfigurasi Security Groups (inbound/outbound rules), Elastic IP allocation, dan manajemen volume EBS.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'AWS Certified Solutions Architect Associate (SAA-C03)',
                'display_order'       => 4,
            ],
            [
                'phase_name'          => '02 // AWS Core Compute & Storage Services',
                'title'               => 'Amazon S3 Object Storage & Lifecycle Policies',
                'description'         => 'Penyimpanan objek S3 (Buckets, Objects, S3 Standard vs Glacier), konfigurasi Bucket Policies, IAM access control, Cross-Origin Resource Sharing (CORS), serta siklus arsip data.',
                'status'              => RoadmapCheckpoint::STATUS_IN_PROGRESS,
                'source_reference'    => 'AWS SAA-C03 Study Guide',
                'display_order'       => 5,
            ],
            [
                'phase_name'          => '02 // AWS Core Compute & Storage Services',
                'title'               => 'AWS IAM: Role, Policies, & Least Privilege Access',
                'description'         => 'Penerapan prinsip Least Privilege menggunakan AWS IAM (Users, User Groups, Customer Managed Policies, IAM Roles for EC2, dan Multi-Factor Authentication).',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'AWS Security Best Practices',
                'display_order'       => 6,
            ],

            // ── FASE 3: AWS Networking & Content Delivery (VPC & Route 53) ──
            [
                'phase_name'          => '03 // AWS Networking & Content Delivery',
                'title'               => 'Amazon VPC Architecture: Subnets, Route Tables & IGW',
                'description'         => 'Desain jaringan virtual privat terisolasi (Amazon VPC), perancangan Public Subnet vs Private Subnet, Internet Gateway (IGW), NAT Gateway, dan Network Access Control Lists (NACL).',
                'status'              => RoadmapCheckpoint::STATUS_IN_PROGRESS,
                'source_reference'    => 'AWS Certified Solutions Architect Associate',
                'display_order'       => 7,
            ],
            [
                'phase_name'          => '03 // AWS Networking & Content Delivery',
                'title'               => 'Amazon Route 53 & Cloudflare DNS Edge Integration',
                'description'         => 'Manajemen DNS public hosted zone di Route 53 / Cloudflare, konfigurasi Record A, CNAME, TXT, routing policies (Simple, Failover), dan setup SSL/TLS Edge Certificates.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'AWS Route 53 & Cloud Networking Guide',
                'display_order'       => 8,
            ],

            // ── FASE 4: Containerization & Modern Web Deployment ──
            [
                'phase_name'          => '04 // Containerization & Modern Web Deployment',
                'title'               => 'Docker Fundamentals: Images, Containers & Volumes',
                'description'         => 'Konsep kontainerisasi aplikasi vs virtual machine, pembuatan custom image via Dockerfile multi-stage build, container lifecycle, dan manajemen persistensi data dengan Docker Named Volumes.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'Docker Certified Associate (DCA) Curriculum',
                'display_order'       => 9,
            ],
            [
                'phase_name'          => '04 // Containerization & Modern Web Deployment',
                'title'               => 'Multi-Container Orchestration with Docker Compose',
                'description'         => 'Orkestrasi multi-kontainer production (Nginx reverse proxy, PHP-FPM, MySQL 8.0, Redis cache) dalam isolated bridge network menggunakan deklarasi docker-compose.yml.',
                'status'              => RoadmapCheckpoint::STATUS_FINISHED,
                'source_reference'    => 'Production Docker Compose Best Practices',
                'display_order'       => 10,
            ],
            [
                'phase_name'          => '04 // Containerization & Modern Web Deployment',
                'title'               => 'Nginx Web Server Tuning & Reverse Proxy Architecture',
                'description'         => 'Konfigurasi Nginx sebagai reverse proxy server, FastCGI parameter passing ke PHP-FPM, HTTP security headers, Gzip compression, serta SSL termination Let\'s Encrypt / Certbot.',
                'status'              => RoadmapCheckpoint::STATUS_IN_PROGRESS,
                'source_reference'    => 'High Performance Nginx Tuning',
                'display_order'       => 11,
            ],

            // ── FASE 5: Cloud Monitoring, Reliability & CI/CD Pipelines ──
            [
                'phase_name'          => '05 // Cloud Monitoring & CI/CD Automation',
                'title'               => 'Amazon CloudWatch: Metrics, Alarms & Centralized Logging',
                'description'         => 'Monitoring performa instance (CPU utilization, Disk I/O, Network in/out), pembuatan CloudWatch Alarms dengan notifikasi email SNS, dan agregasi log container via CloudWatch Logs Agent.',
                'status'              => RoadmapCheckpoint::STATUS_NOT_STARTED,
                'source_reference'    => 'AWS Well-Architected Framework: Reliability Pillar',
                'display_order'       => 12,
            ],
            [
                'phase_name'          => '05 // Cloud Monitoring & CI/CD Automation',
                'title'               => 'CI/CD Pipelines: Automated Testing & EC2 Deployment',
                'description'         => 'Otomatisasi siklus deployment aplikasi menggunakan GitHub Actions: pipeline running lint & unit tests, pembuatan artifact, dan automated deploy over SSH ke remote EC2 server.',
                'status'              => RoadmapCheckpoint::STATUS_IN_PROGRESS,
                'source_reference'    => 'DevOps Continuous Deployment Best Practices',
                'display_order'       => 13,
            ],
        ];

        RoadmapCheckpoint::where('roadmap_role_id', $cloudRole->id)->delete();
        foreach ($cloudCheckpoints as $item) {
            $item['roadmap_role_id'] = $cloudRole->id;
            if ($cloudNote && (str_contains(strtolower($item['title']), 'ec2') || str_contains(strtolower($item['title']), 'docker') || str_contains(strtolower($item['title']), 'linux'))) {
                $item['learning_log_entry_id'] = $cloudNote->id;
            }
            if ($cloudProject) {
                $item['project_id'] = $cloudProject->id;
            }
            RoadmapCheckpoint::create($item);
        }
    }
}
