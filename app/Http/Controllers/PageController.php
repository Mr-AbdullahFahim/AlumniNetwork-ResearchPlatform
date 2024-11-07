<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        // Example data; replace with actual data from your database if needed
        $teamMembers = [
            (object) [
                'name' => 'Abdullah Fahim',
                'role' => 'Project Manager',
                'description' => 'Leads the team and contributes to both backend and frontend development, ensuring seamless integration and optimal project delivery',
                'image' => 'https://scontent.fcmb10-1.fna.fbcdn.net/v/t39.30808-6/441505737_1440365656845673_6381019357022896289_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=G6bWSxJlkxgQ7kNvgE1_w3I&_nc_zt=23&_nc_ht=scontent.fcmb10-1.fna&_nc_gid=AJTS4TMVxbVDy5zP4Nvkbry&oh=00_AYDSLcbkBuR2se4tALRojDKx-ui_2nqp3QCm7lvz5TkwzQ&oe=6732D702',
                'linkedin' => 'https://www.linkedin.com/in/mr-abdullah/',
                'email' => 'abdullahfahim@gmail.com',
                'github' => 'https://github.com/Mr-AbdullahFahim'
            ],
            (object) [
                'name' => 'Tharusha Randima',
                'role' => 'Full Stack Developer',
                'description' => 'Worked on both backend and frontend, ensuring smooth integration and optimizing performance and functionality.',
                'image' => 'https://scontent.fcmb10-1.fna.fbcdn.net/v/t39.30808-6/316238373_3395115637437664_164630928003877998_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=7xmlUJQPnF8Q7kNvgHFPfuT&_nc_zt=23&_nc_ht=scontent.fcmb10-1.fna&_nc_gid=AJ7JZelv6N341Cn3Bta9Cle&oh=00_AYDAaho4LWP0_q-EhJeUl3xkCRpUQEkeBOYvpcee6VD2SQ&oe=6732C007',
                'linkedin' => 'https://www.linkedin.com/in/randimaabhayawardhana/',
                'email' => 'tharusharandima1@gmail.com',
                'github' => 'https://github.com/RandimaAbhayawardhana'
            ],
            (object) [
                'name' => 'Haritha Senadheera',
                'role' => 'Database Administrator',
                'description' => 'Manages and optimizes the database to ensure secure, efficient, and reliable data storage',
                'image' => 'https://media.licdn.com/dms/image/v2/D5603AQEf6aKQ4HpEiA/profile-displayphoto-shrink_800_800/profile-displayphoto-shrink_800_800/0/1674372557088?e=1735776000&v=beta&t=FU5zhECbZep_KfhBTUrfduYVfSeRxUEJ5_9oHTXijOY',
                'linkedin' => 'https://www.linkedin.com/in/harithase/',
                'email' => 'harithasenadheera1@gmail.com',
                'github' => 'https://github.com/HarithaSe'
            ],
            (object) [
                'name' => 'Dasun Tharuka',
                'role' => 'Frontend Developer',
                'description' => 'Worked on UI components and layouts, focusing on making the platform more user-friendly.',
                'image' => 'https://scontent.fcmb10-1.fna.fbcdn.net/v/t39.30808-6/422933014_342283745374193_4516130476703135882_n.jpg?stp=cp6_dst-jpg&_nc_cat=110&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=lu0wBPC9IGQQ7kNvgFdpaMw&_nc_zt=23&_nc_ht=scontent.fcmb10-1.fna&_nc_gid=A1aFGHBQpbR5peQsGbUftAm&oh=00_AYDyMGYQMiFSuvZysMYdL532U_kW9noQAyCZobbvDHTX3Q&oe=6732BDF7',
                'linkedin' => 'https://linkedin.com/in/johndoe',
                'email' => 'https://twitter.com/johndoe',
                'github' => 'https://github.com/johndoe'
            ],
            (object) [
                'name' => 'Lakshan Rashoga',
                'role' => 'Coordinator',
                'description' => 'Connects alumni and researchers, facilitating collaborations and sharing research opportunities across the platform.',
                'image' => 'https://scontent.fcmb10-1.fna.fbcdn.net/v/t39.30808-6/442445016_3744911739117327_2848047424996227460_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=LQsBSzlBzhUQ7kNvgGoe83f&_nc_zt=23&_nc_ht=scontent.fcmb10-1.fna&_nc_gid=Abr8k-MgrYkNPnsImo671ia&oh=00_AYBZOAK4bpQE-ezCn7bvUQWCWc2QVC_BY4_3EJ_OiB4eJQ&oe=6732BC85',
                'linkedin' => 'https://linkedin.com/in/johndoe',
                'email' => 'https://twitter.com/johndoe',
                'github' => 'https://github.com/johndoe'
            ],
            (object) [
                'name' => 'Sujishan',
                'role' => 'QA Tester',
                'description' => 'Tested the platform to ensure it functions as expected, reporting bugs.',
                'image' => 'https://scontent.fcmb10-1.fna.fbcdn.net/v/t39.30808-6/241535453_1028839091201197_7439289708859514842_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=a5f93a&_nc_ohc=hT5SRyYuMlUQ7kNvgG5nzQy&_nc_zt=23&_nc_ht=scontent.fcmb10-1.fna&_nc_gid=A1zvd1Oma6Ya2Qr_bjQm6XG&oh=00_AYApHXE3Ya6A_1eqiWfPRNpzxJQCBNr965_MuZQ2paxIYA&oe=6732B613',
                'linkedin' => 'https://linkedin.com/in/johndoe',
                'email' => 'https://twitter.com/johndoe',
                'github' => 'https://github.com/johndoe'
            ],
            // Add more members as needed
        ];

        return view('about', compact('teamMembers'));
    }
}
