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
                'description' => 'Leads the team with a passion for technology and innovation.',
                'image' => 'https://scontent-bom1-1.xx.fbcdn.net/v/t39.30808-6/441505737_1440365656845673_6381019357022896289_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=eRgno9e6j1MQ7kNvgE9qzfZ&_nc_zt=23&_nc_ht=scontent-bom1-1.xx&_nc_gid=A26NRBlULIoRLCfLejdA2IM&oh=00_AYDxMYDqZTCsHtsAwm_IR-XYDqg4VbjdLlfo24GdVr6u8A&oe=6728F3C2',
                'linkedin' => 'https://linkedin.com/in/johndoe',
                'email' => 'https://twitter.com/johndoe',
                'github' => 'https://github.com/johndoe'
            ],
            (object) [
                'name' => 'Tharusha Randima',
                'role' => 'Developer',
                'description' => 'Leads the team with a passion for technology and innovation.',
                'image' => 'https://scontent-bom2-2.xx.fbcdn.net/v/t39.30808-6/316238373_3395115637437664_164630928003877998_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=xwUxajljL7AQ7kNvgGJBbRW&_nc_zt=23&_nc_ht=scontent-bom2-2.xx&_nc_gid=AgaeO8miTt8vI3a2FHqg4Cn&oh=00_AYAx3KMTrExUNzHbn1DI7V7cmg0BeF_DNCiaC9OUvxpjgw&oe=67291507',
                'linkedin' => 'https://linkedin.com/in/johndoe',
                'email' => 'https://twitter.com/johndoe',
                'github' => 'https://github.com/johndoe'
            ],
            (object) [
                'name' => 'Haritha Senadheera',
                'role' => 'Designer',
                'description' => 'Leads the team with a passion for technology and innovation.',
                'image' => 'https://media.licdn.com/dms/image/v2/D5603AQEf6aKQ4HpEiA/profile-displayphoto-shrink_800_800/profile-displayphoto-shrink_800_800/0/1674372557088?e=1735776000&v=beta&t=FU5zhECbZep_KfhBTUrfduYVfSeRxUEJ5_9oHTXijOY',
                'linkedin' => 'https://linkedin.com/in/johndoe',
                'email' => 'https://twitter.com/johndoe',
                'github' => 'https://github.com/johndoe'
            ],
            (object) [
                'name' => 'Haritha Senadheera',
                'role' => 'Designer',
                'description' => 'Leads the team with a passion for technology and innovation.',
                'image' => 'https://media.licdn.com/dms/image/v2/D5603AQEf6aKQ4HpEiA/profile-displayphoto-shrink_800_800/profile-displayphoto-shrink_800_800/0/1674372557088?e=1735776000&v=beta&t=FU5zhECbZep_KfhBTUrfduYVfSeRxUEJ5_9oHTXijOY',
                'linkedin' => 'https://linkedin.com/in/johndoe',
                'email' => 'https://twitter.com/johndoe',
                'github' => 'https://github.com/johndoe'
            ],
            (object) [
                'name' => 'Haritha Senadheera',
                'role' => 'Designer',
                'description' => 'Leads the team with a passion for technology and innovation.',
                'image' => 'https://media.licdn.com/dms/image/v2/D5603AQEf6aKQ4HpEiA/profile-displayphoto-shrink_800_800/profile-displayphoto-shrink_800_800/0/1674372557088?e=1735776000&v=beta&t=FU5zhECbZep_KfhBTUrfduYVfSeRxUEJ5_9oHTXijOY',
                'linkedin' => 'https://linkedin.com/in/johndoe',
                'email' => 'https://twitter.com/johndoe',
                'github' => 'https://github.com/johndoe'
            ],
            (object) [
                'name' => 'Haritha Senadheera',
                'role' => 'Designer',
                'description' => 'Leads the team with a passion for technology and innovation.',
                'image' => 'https://media.licdn.com/dms/image/v2/D5603AQEf6aKQ4HpEiA/profile-displayphoto-shrink_800_800/profile-displayphoto-shrink_800_800/0/1674372557088?e=1735776000&v=beta&t=FU5zhECbZep_KfhBTUrfduYVfSeRxUEJ5_9oHTXijOY',
                'linkedin' => 'https://linkedin.com/in/johndoe',
                'email' => 'https://twitter.com/johndoe',
                'github' => 'https://github.com/johndoe'
            ],
            // Add more members as needed
        ];

        return view('about', compact('teamMembers'));
    }
}
