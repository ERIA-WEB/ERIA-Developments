<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/about-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/history-update.css">
<link rel="stylesheet" href="<?php echo base_url() ?>v6/css/dabase-update.css">
<style>
    html,
    body {
        margin: 0px;
        padding: 0px;
        overflow-x: hidden;
    }

    .title {
        font-size: 23px;
        font-family: 'Merriweather';
    }

    .advisors-president .heading {
        font-size: 23px;
        font-family: 'Merriweather';
    }


    .experts-detail-page .author-detail img {
        border-radius: 0;
        width: 100%;
    }

    @media screen and (max-width: 767px) {

        .advisors-president .image-container {
            border-radius: 100%;
            width: 267px;
            height: auto;
            background: #fff;
        }
    }

    @media screen and (max-width: 426px) {

        .advisors-president .image-container {
            width: 100%;
        }
    }

    @media (max-width: 767.98px) {
        .sticky_cha {
            top: 0px !important;
        }

        .pt-2.mobile-search {
            display: block !important;
        }

        .navbar-light .navbar-toggler {
            border-color: rgba(0, 0, 0, 0) !important;
        }

        .mobile-nav-bar {
            display: flex !important;
        }
    }
</style>
<div class="container experts-detail-page advisors-president section-top">
    <div class="row">

        <div id=" " class="  col-md-4">
            <?php $this->load->view('front-end/common/left'); ?>

        </div>
        <div class="col-md-8 col-12 author-detail">
            <div class="experts-page-title pb-3 mb-3">Advisors to the President and the President's Office</div>

            <!-- Cards -->
            <div class="heading">Advisors to the President</div>

            <div class="row pb-4">
                <div class="col-md-3 col-12">
                    <div class="image-container">
                        <img src="<?php echo base_url() ?>v6/assets/Images/About/advisor_1.png">
                    </div>
                </div>
                <div class="col-md-9 col-12">
                    <div class="title">Shigeru Kimura</div>
                    <div class="pb-2 position">Special Advisor on Energy Affairs</div>
                    <p class="advisor-description">Shigeru Kimura graduated from the Faculty of Computer and Information Sciences, Hosei University in 1973.
                        After graduation, he started working for Century Research Center Co. (CRC), one of Japanese think tanks
                        and became manager of Economic Group, Research Institute of CRC in 1988. He joined the Energy Data and
                        Modelling Center (EDMC), the Institute of Energy Economics, Japan (IEEJ) as head of Statistics Information
                        Office in 1993 and became Senior Research Fellow in 2005. He has been engaged in preparation of energy
                        statistics in APEC region as coordinator and energy modeling work applying econometric and input-output
                        approaches for a long time. Using these expertises, he has been conducting capacity building on energy
                        statistics and energy outlook modeling in Association of South East Asian Nations (ASEAN) region for more
                        than 10 years. He has been also in charge as leader of Working Group for Preparation of Energy Outlook and
                        Analysis of Energy Saving Potential in East Asia, Economic Research Institute for ASEAN and East Asia
                        (ERIA) from 2007. From August 2013, he has been in charge of Special Adviser to Executive Director on
                        Energy Affairs of ERIA additionally. He retired IEEJ in September 2015 and moved to ERIA completely
                        keeping same position.</p>
                </div>
            </div>

            <div class="row pb-4">
                <div class="col-md-3 col-12">
                    <div class="image-container">
                        <img src="<?php echo base_url() ?>v6/assets/Images/About/advisor_2.png">
                    </div>
                </div>
                <div class="col-md-9 col-12">
                    <div class="title">Dr Osuke Komazawa</div>
                    <div class="pb-2 position">Special Advisor on Healthcare & Long Term Care Policy</div>
                    <p class="advisor-description">Osuke Komazawa graduated from School of Medicine, Tohoku University in 2000 and obtained medical doctor's
                        licence in the same year. He underwent five years' training as ENT surgeon.
                        In 2005, he entered PhD course of Graduate School of Biomedical Sciences, Nagasaki University, being
                        interested in demographic transition, health transition and sustainability of development of human beings.
                        During his PhD course, he joined the project to establish Health and Demographic Surveillance System
                        (HDSS) in the rural areas of Western and Coastal Kenya and conducted fieldwork in the target areas of
                        HDSS. His dissertation focuses on the community effect of long-lasting insecticide-treated bed nets
                        (LLINs), which implies that the mass distribution of LLINs can be effective not only for net users but
                        also non users. Nagasaki University conferred a PhD degree on him in 2013.
                        He was appointed as the resident director of Nairobi Research Station, Japan Society for the Promotion of
                        Science (JSPS), in 2009. During his two years' duty in Nairobi, he hosted several scientific symposia and
                        conferences which supported scientists from various parts of the world to collaborate on the scientific
                        research conducted in Africa. He also contributed to making of MoU between JSPS and the Kenyan counterpart
                        under Kenyan government.
                        After he resumed working as an ENT surgeon at Nagasaki University Hospital from 2013 to 2015, he
                        transferred to Ministry of Health, Labour and Welfare of Japan (MHLW). He was assigned to a position in
                        Health Insurance Bureau and later under the Director-General for Statistics and Information Policy.</p>
                </div>
            </div>

            <div class="row pb-5">
                <div class="col-md-3 col-12">
                    <div class="image-container">
                        <img src="<?php echo base_url() ?>v6/assets/Images/About/advisor_3.png">
                    </div>
                </div>
                <div class="col-md-9 col-12">
                    <div class="title">Professor Shujiro Urata</div>
                    <div class="pb-2 position">Senior Research Advisor to the President of ERIA</div>
                    <p class="advisor-description">Shujiro Urata received his PhD in Economics from Standford University in 1978. Before joining ERIA as a
                        senior research advisor, he was affiliated with Waseda University wherein he served as professor since
                        1988. His focus of research is in international and development economics.</p>
                </div>
            </div>

            <div class="row pb-4">
                <div class="col-md-3 col-12">
                    <div class="image-container">
                        <img src="<?php echo base_url() ?>v6/assets/Images/About/advisor_4.png">
                    </div>
                </div>
                <div class="col-md-9 col-12">
                    <div class="title">Professor Akiko Yamanaka</div>
                    <div class="pb-2 position">Special Advisor to the President, Economic Research Institute for ASEAN and East
                        Asia(ERIA), Former Vice Minister for Foreign Affairs and Special Ambassador for Peacebuilding, Japan</div>
                    <p class="advisor-description">Professor Akiko Yamanaka has been active in both academia and the political arena. As an academic, she
                        has been a By-fellow of Churchill College, Cambridge University and a visiting professor at the Graduate
                        School of Hokkaido University, as well as at the United Nations University. Currently she serves as a
                        Senior Diplomatic Fellow at the Cambridge Central Asia Forum serves and as a visiting professor at Tenjin
                        Foreign Studies University. She has also been a Senior Visiting Researcher at St. Antony's College, Oxford
                        University and at the Center for Strategic and International Studies in the United States. In the
                        political arena, she has served as the Member of the House of Representatives of Japan as well as
                        Vice-Minister for Foreign Affairs, Director of the Committee of Foreign Affairs, and Director General of
                        the Women's Bureau of Liberal Democratic Party. Her areas of expertise include International Peacebuilding
                        and Preventive State Theory, International Negotiation and Strategic Studies, and Intercultural Studies.
                        On these and other subjects, she has written and lectured extensively. She has published many books
                        including 'Think, or Sink: Preventive State Theory', 'Toward the Future: Human Security', 'From the Window
                        of Oxford', and others. She was awarded the OISCA prize for 'Contribution to Asia' and International
                        Soroptimist Japan's Sen Kyoko prize for her contributions to international understanding. She is currently
                        working on Human Development for Peacebuilding, and on Human Security, especially water security, food
                        security and energy security as well as on Natural and Human Induced Disaster Prevention and Mitigation.
                    </p>
                </div>
            </div>

            <div class="heading">The President's Office</div>

            <div class="row pb-4">
                <div class="col-md-3 col-12">
                    <div class="image-container">
                        <img src="<?php echo base_url() ?>v6/assets/Images/About/advisor_5.png">
                    </div>
                </div>
                <div class="col-md-9 col-12">
                    <div class="title">Anita Prakash</div>
                    <div class="pb-2 position">Director for Policy Relations</div>
                    <p class="advisor-description">Anita Prakash is Director for Policy Relations in ERIA. Her key role is policy support to Leaders and
                        senior officials in the governments of Southeast Asia, East Asia and Oceania on political economy, growth,
                        narrowing development gaps, regional economic integration and related matters, using the research results
                        of ERIA. She works closely with ASEAN Member states and their Dialogue Partners in the Asia Pacific
                        Region, and also in Europe. She is presently a Visiting Fellow at the Graduate Institute of International
                        and Development Studies, Geneva.</p>
                </div>
            </div>

        </div>

    </div>



</div>