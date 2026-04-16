<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

return array(
    array(
        'slug'    => 'when-stopped-by-police',
        'title'   => 'When Stopped by Police',
        'summary' => 'What you can say, what you must show, and how to stay safe during a traffic or street stop.',
        'icon'    => 'shield',
        'scenarios' => array(
            array(
                'situation' => 'An officer pulls you over on the road',
                'right'     => 'You must show your license, registration, and proof of insurance. You do not have to answer questions about where you are going or where you have been; you have the right to remain silent.',
                'action'    => 'Keep your hands visible on the wheel, stay calm, and say: "Officer, I\'m going to remain silent. Am I free to go?"',
            ),
            array(
                'situation' => 'A police officer stops you on the street and starts asking questions',
                'right'     => 'In most situations you are not required to answer questions, and you can ask whether you are being detained. If you are not being detained, you are free to walk away.',
                'action'    => 'Politely ask: "Am I being detained, or am I free to go?" If the officer says you are free to go, calmly leave.',
            ),
            array(
                'situation' => 'An officer asks to search your car or your pockets',
                'right'     => 'You do not have to consent to a search of your car, bag, or person without a warrant or probable cause. Saying no does not give the officer probable cause.',
                'action'    => 'Clearly say: "I do not consent to any searches." Do not physically resist if the officer searches anyway; challenge it later in court.',
            ),
            array(
                'situation' => 'An officer asks for your name and ID while you are walking',
                'right'     => 'Some states have "stop and identify" laws that require you to give your name if the officer has reasonable suspicion of a crime. In other states, you do not have to identify yourself at all.',
                'action'    => 'Ask if you are being detained. If you live in a stop-and-identify state, provide your name but nothing more, and say: "I\'m going to remain silent."',
            ),
        ),
        'related_amendments' => array( 4, 5 ),
    ),

    array(
        'slug'    => 'at-your-home',
        'title'   => 'At Your Home',
        'summary' => 'What officers can and cannot do at your door, and how warrants and consent work inside your home.',
        'icon'    => 'shield',
        'scenarios' => array(
            array(
                'situation' => 'Police knock on your door and ask to come inside',
                'right'     => 'Officers generally cannot enter your home without a warrant, your consent, or an emergency. You have the right to refuse entry and to speak with them through the door.',
                'action'    => 'Keep the door closed or open it only partially, and say: "I do not consent to you entering. Do you have a warrant?"',
            ),
            array(
                'situation' => 'Officers say they have a warrant to search your home',
                'right'     => 'You have the right to see the warrant and check that it lists your address and what the officers are allowed to search for. A valid search warrant must be signed by a judge.',
                'action'    => 'Ask them to slide the warrant under the door or hold it up to a window. Do not interfere with the search, but say: "I do not consent to any search beyond what the warrant allows."',
            ),
            array(
                'situation' => 'An officer claims there is an emergency and enters without a warrant',
                'right'     => 'Police can enter without a warrant only in narrow situations such as hot pursuit, preventing evidence destruction, or responding to a serious emergency. You can still state your objection for the record.',
                'action'    => 'Do not physically resist. Clearly say: "I do not consent to this entry or search," and write down everything that happens as soon as you can.',
            ),
            array(
                'situation' => 'Immigration agents (ICE) come to your door',
                'right'     => 'ICE usually carries an administrative warrant, which does not give them the authority to enter your home without your consent. Only a judicial warrant signed by a judge allows forced entry.',
                'action'    => 'Do not open the door. Ask them to slide any warrant under the door, and say: "I do not consent to you entering. I wish to remain silent and speak with a lawyer."',
            ),
        ),
        'related_amendments' => array( 4 ),
    ),

    array(
        'slug'    => 'if-arrested-or-detained',
        'title'   => 'If Arrested or Detained',
        'summary' => 'Your core protections when you are in custody: silence, a lawyer, and a phone call.',
        'icon'    => 'shield',
        'scenarios' => array(
            array(
                'situation' => 'You are placed in handcuffs and told you are under arrest',
                'right'     => 'You have the right to remain silent and the right to an attorney. Anything you say can be used against you, even casual comments in the squad car.',
                'action'    => 'Clearly state out loud: "I am invoking my right to remain silent, and I want a lawyer." Then stop talking until your lawyer arrives.',
            ),
            array(
                'situation' => 'Officers begin questioning you at the station',
                'right'     => 'Once you ask for a lawyer, questioning must stop until your lawyer is present. If you cannot afford a lawyer, one will be appointed for you.',
                'action'    => 'Repeat clearly: "I want a lawyer. I do not want to answer any questions without my lawyer." Do not waive this right even if officers say it will help you.',
            ),
            array(
                'situation' => 'You are allowed to make a phone call',
                'right'     => 'Most jurisdictions allow detained people to make a phone call within a reasonable time. Calls to your lawyer are confidential; calls to friends and family are usually recorded.',
                'action'    => 'Call a lawyer or a trusted person who can contact a lawyer. Do not discuss the facts of your case on a recorded line.',
            ),
            array(
                'situation' => 'Officers pressure you to sign a statement or waiver',
                'right'     => 'You are not required to sign anything without a lawyer reviewing it. Signing a waiver of rights can be used against you later.',
                'action'    => 'Say: "I will not sign anything until I speak with my attorney." Stay calm and wait for legal counsel.',
            ),
        ),
        'related_amendments' => array( 5, 6 ),
    ),

    array(
        'slug'    => 'at-work',
        'title'   => 'At Work',
        'summary' => 'Your baseline protections against discrimination, wage theft, harassment, and retaliation on the job.',
        'icon'    => 'book',
        'scenarios' => array(
            array(
                'situation' => 'You are passed over for a promotion because of your race, sex, religion, age, or disability',
                'right'     => 'Federal laws like Title VII, the ADA, and the ADEA prohibit workplace discrimination based on protected characteristics. Many states add further protections.',
                'action'    => 'Document what happened with dates and witnesses, then file a charge with the Equal Employment Opportunity Commission (EEOC) within 180 to 300 days.',
            ),
            array(
                'situation' => 'Your employer is not paying you for all the hours you worked or denies you overtime',
                'right'     => 'The Fair Labor Standards Act requires employers to pay at least the minimum wage and overtime for hours over 40 per week for most non-exempt workers.',
                'action'    => 'Keep your own record of hours worked. File a wage complaint with the U.S. Department of Labor\'s Wage and Hour Division or your state labor agency.',
            ),
            array(
                'situation' => 'A coworker or manager is sexually harassing you',
                'right'     => 'You have the right to a workplace free of sexual harassment, and employers are required to take reasonable steps to prevent and correct it.',
                'action'    => 'Report the harassment in writing through your company\'s process, keep copies, and consider filing with the EEOC if it continues or you face retaliation.',
            ),
            array(
                'situation' => 'You want to talk with coworkers about pay or forming a union',
                'right'     => 'The National Labor Relations Act protects most private-sector workers who discuss wages, working conditions, or union activity together, even without a formal union.',
                'action'    => 'Keep conversations respectful and outside of work duties when possible. If you are disciplined for this activity, contact the National Labor Relations Board.',
            ),
        ),
        'related_amendments' => array( 14 ),
    ),

    array(
        'slug'    => 'as-a-renter',
        'title'   => 'As a Renter',
        'summary' => 'How landlord entry, repairs, evictions, and security deposits work in most states.',
        'icon'    => 'book',
        'scenarios' => array(
            array(
                'situation' => 'Your landlord shows up unannounced and wants to come inside',
                'right'     => 'In most states, a landlord must give reasonable advance notice (often 24 to 48 hours) and enter only for legitimate reasons like repairs or showings. Emergencies are the main exception.',
                'action'    => 'Politely ask for the reason and whether proper notice was given. Put your objection in writing: "I do not consent to entry without proper notice."',
            ),
            array(
                'situation' => 'A serious repair like heat, plumbing, or a leak has been ignored for weeks',
                'right'     => 'Most states recognize an "implied warranty of habitability," meaning your rental must be safe and livable. Ignoring major repairs can violate this duty.',
                'action'    => 'Send a dated written request describing the problem and keep a copy. If it is still ignored, contact your local code enforcement or a tenant legal aid office.',
            ),
            array(
                'situation' => 'You receive an eviction notice or your landlord threatens to lock you out',
                'right'     => 'In almost every state, a landlord cannot evict you without going through court and getting a judge\'s order. Changing locks or shutting off utilities to force you out is illegal.',
                'action'    => 'Do not move out based on a threat alone. Save every document, respond to any court papers on time, and seek help from legal aid or tenant rights groups right away.',
            ),
            array(
                'situation' => 'Your landlord refuses to return your security deposit after you move out',
                'right'     => 'State laws set strict deadlines (often 14 to 30 days) for returning deposits or providing an itemized list of deductions. Wrongful withholding can lead to penalties.',
                'action'    => 'Send a written demand letter with your forwarding address and move-out photos. If ignored, file a claim in small claims court.',
            ),
        ),
        'related_amendments' => array( 4 ),
    ),

    array(
        'slug'    => 'at-school',
        'title'   => 'At School',
        'summary' => 'How free speech, searches, and discipline rules apply to public-school students.',
        'icon'    => 'book',
        'scenarios' => array(
            array(
                'situation' => 'You want to wear a T-shirt or armband expressing a political view',
                'right'     => 'Public-school students do not "shed their constitutional rights at the schoolhouse gate." Schools can only limit speech that substantially disrupts learning or invades others\' rights.',
                'action'    => 'If your speech is peaceful and not disruptive, you can generally express it. If punished, document the incident and contact a civil liberties group.',
            ),
            array(
                'situation' => 'A school official wants to search your locker, backpack, or phone',
                'right'     => 'School officials need only "reasonable suspicion" to search, which is a lower bar than police. However, searches must still be reasonable in scope and not overly intrusive.',
                'action'    => 'Calmly say: "I do not consent to this search." Do not physically resist, but note what was searched and ask your parents to follow up.',
            ),
            array(
                'situation' => 'You are facing suspension or expulsion',
                'right'     => 'The Fourteenth Amendment\'s due process clause requires that students get notice of the charges and a chance to respond before serious discipline, especially for longer suspensions and expulsions.',
                'action'    => 'Request the rules in writing, attend any hearings with a parent or advocate, and keep a clear record of what you were told and when.',
            ),
            array(
                'situation' => 'Police officers or school resource officers want to question you at school',
                'right'     => 'You still have the right to remain silent and to ask for a parent or lawyer before answering questions from police, even inside a school building.',
                'action'    => 'Say: "I want to speak with my parent and a lawyer before I answer any questions." Do not sign anything without an adult you trust.',
            ),
        ),
        'related_amendments' => array( 1, 4, 14 ),
    ),

    array(
        'slug'    => 'when-voting',
        'title'   => 'When Voting',
        'summary' => 'What to expect at the polls and how to protect your right to cast a ballot.',
        'icon'    => 'bulb',
        'scenarios' => array(
            array(
                'situation' => 'A poll worker tells you that you are not on the voter list',
                'right'     => 'Under the Help America Vote Act, you have the right to request a provisional ballot if your eligibility is questioned. That ballot is counted once your registration is confirmed.',
                'action'    => 'Politely ask: "I would like to cast a provisional ballot, please." Then follow up after the election to make sure your ballot was counted.',
            ),
            array(
                'situation' => 'You are asked for a specific ID you do not have',
                'right'     => 'ID requirements vary by state. Some states require photo ID, others accept alternatives, and some let you sign an affidavit or cast a provisional ballot instead.',
                'action'    => 'Know your state\'s rules before election day. At the polls, ask about alternatives and request a provisional ballot if you are turned away.',
            ),
            array(
                'situation' => 'You need help reading or marking your ballot',
                'right'     => 'Federal law allows voters with disabilities or limited English to bring a person of their choice into the voting booth, with narrow exceptions such as an employer or union agent.',
                'action'    => 'Bring someone you trust and tell the poll worker you need assistance under Section 208 of the Voting Rights Act.',
            ),
            array(
                'situation' => 'Someone at the polls challenges your right to vote',
                'right'     => 'Voter challenges must follow strict legal procedures, and you cannot be turned away based on appearance, accent, or a stranger\'s accusation. You still have the right to a provisional ballot.',
                'action'    => 'Stay calm and ask to speak with the chief election judge. Call the nonpartisan Election Protection hotline at 866-OUR-VOTE for help.',
            ),
        ),
        'related_amendments' => array( 15, 19, 24, 26 ),
    ),

    array(
        'slug'    => 'as-a-protester',
        'title'   => 'As a Protester',
        'summary' => 'Your rights to gather, speak, record, and stay safe at public demonstrations.',
        'icon'    => 'chat',
        'scenarios' => array(
            array(
                'situation' => 'You want to hold a protest on a public sidewalk or in a park',
                'right'     => 'The First Amendment strongly protects peaceful assembly and speech in traditional public forums like sidewalks, streets, and parks. Cities can require permits for large marches but cannot base approval on the message.',
                'action'    => 'Check local permit rules for marches and sound equipment. Stay on public property, keep walkways clear, and remain peaceful.',
            ),
            array(
                'situation' => 'You want to record police activity at a protest',
                'right'     => 'You have a First Amendment right to record police performing their duties in public, as long as you do not physically interfere with their work.',
                'action'    => 'Stay a safe distance back, keep your phone visible, and narrate calmly. If ordered to move, move but keep recording from a legal spot.',
            ),
            array(
                'situation' => 'Officers order the crowd to disperse',
                'right'     => 'Police can order a crowd to leave if a protest turns unlawful, but they must give a clear warning and a reasonable chance to leave before making arrests.',
                'action'    => 'If a dispersal order is given, leave calmly by the route officers indicate. If you are blocked in, keep your hands visible and do not resist.',
            ),
            array(
                'situation' => 'You are arrested while protesting',
                'right'     => 'You keep all of your rights at a protest: to remain silent, to refuse consent to searches, and to ask for a lawyer before any questioning.',
                'action'    => 'Say out loud: "I am going to remain silent and I want a lawyer." Write a legal-support number on your arm beforehand so you can call for help.',
            ),
        ),
        'related_amendments' => array( 1, 4 ),
    ),

);
