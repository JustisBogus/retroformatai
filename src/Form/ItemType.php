<?php

namespace App\Form;

use App\Entity\Item;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemType extends AbstractType
{
    public const HONEYPOT_FIELD_NAME = 'honeypot';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder->add('title', TextType::class)
                ->add('format', ChoiceType::class, [
                    'choices' => [
                        'Disketės' => [
                            'Atari 2600' => 'atari_2600',
                            'Famicom / NES / Klonai' => 'nes',
                            'Super Famicom / SNES' => 'snes',
                            'Nintendo 64' => 'nintendo_64',
                            'Sega Master System' => 'sega_ms',
                            'Sega Mega Drive / Genesis' => 'sega_genesis',       
                            'Kiti' => 'other_cartridge'
                        ],
                        'Diskai' => [
                            'Nintendo GameCube' => 'nintendo_gc',
                            'Nintendo Wii' => 'nintendo_wii',
                            'Sega CD' => 'sega_cd',
                            'Sega Saturn' => 'sega_saturn',
                            'Sega DreamCast' => 'sega_dreamcast',
                            'Play Station' => 'ps1',
                            'Play Station 2' => 'ps2',
                            'Play Station 3' => 'ps3',
                            'Play Station 4' => 'ps4',
                            'XBox' => 'xbox',
                            'XBox 360' => 'xbox_360',
                            'Xbox One' => 'xbox_one', 
                            'Kiti' => 'other_cd'
                        ],
                        'Nešiojami' => [
                            'Nintendo Game & Watch / Elektronika' => 'game_and_watch',
                            'Nintendo Game Boy' => 'gb',
                            'Nintendo Game Boy Color' => 'gbc',
                            'Nintendo Game Boy Advance' => 'gba',
                            'Nintendo DS' => 'ds',
                            'Nintendo 3DS' => '3ds',
                            'Nintendo Switch' => 'nintendo_switch',
                            'Sega Game Gear' => 'sega_gg',
                            'Play Station Portable' => 'psp',
                            'Play Station Vita' => 'ps_vita',
                            'Kiti' => 'other_portable'
                        ],
                        'Konsolės' => [
                            'VHS Kasetė' => 'vhs',
                            'Video CD' => 'video_cd',
                            'DVD' => 'dvd',
                            'Kiti' => 'other_movies'
                        ]
                    ]
                ])
                ->add('genre1', ChoiceType::class, [
                    'choices' => [
                        'Veiksmas' => 'action',
                        'Nuotykiai' => 'adventure',
                        'Rolės' => 'rpg',
                        'Simuliacija' => 'sim',
                        'Strategija' => 'strategy',
                        'Sportas' => 'sport',
                        'Galvosūkis' => 'puzzle'
                    ]
                ])
                ->add('genre2', ChoiceType::class, [
                    'choices' => [
                        'Veiksmas' => 'action',
                        'Nuotykiai' => 'adventure',
                        'Rolės' => 'rpg',
                        'Simuliacija' => 'sim',
                        'Strategija' => 'strategy',
                        'Sportas' => 'sport',
                        'Galvosūkis' => 'puzzle'
                    ]
                ])
                ->add('releaseDate', ChoiceType::class, [
                    'choices' => range(Date('Y') - 2020, date('Y'))
                ])
                ->add('conditionRating', ChoiceType::class, [
                    'choices' => [
                        '★★★★★' => 5,
                        '★★★★' => 4,
                        '★★★' => 3,
                        '★★' => 2,
                        '★' => 1
                    ]
                ])
                ->add('publisher', TextType::class, ['required' => false, 'label' => 'Leidėjas'])
                ->add('price', TextType::class, ['label' => 'Kaina'])
                ->add(self::HONEYPOT_FIELD_NAME, TextType::class, ['required' => false, 'label' => false])
                ->add('save', SubmitType::class);     
    }

    public function configureOptions(OptionsResolver $resolver)
    {
            $resolver->setDefaults([
                'data_class' => Item::class
            ]);
    }
}