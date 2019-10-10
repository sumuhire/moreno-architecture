<?php
namespace App\Controller;
use App\Entity\Job;
use App\Entity\About;
use App\Entity\Chiffre;
use App\Entity\Contact;
use App\Entity\Project;
use App\Entity\Category;
use App\Entity\Employee;
use App\Entity\Education;
use App\Form\JobFormType;
use App\Entity\JobMission;
use App\Entity\JobProfile;
use App\Form\AboutFormType;
use App\Form\ChiffreFormType;
use App\Form\ContactFormType;
use App\Form\ProjectFormType;
use App\Form\CategoryFormType;
use App\Form\EmployeeFormType;
use App\Form\CategoryEditFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class DefaultController extends AbstractController{

    public function contact(Request $request, \Swift_Mailer $mailer){

        $contact = new Contact();

        $contactForm = $this->createForm(ContactFormType::class, $contact, ['standalone' => true]);

        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
                     
            /**
             * Set Password
             */
            // $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            // $user->setPassword($password);
                $name = $contact->getFullName();
                $email = $contact->getEmail();
                   
                $message = (new \Swift_Message('New contact via www.steveumuhire.com'))
                ->setFrom("info@steveumuhire.com")
                ->setTo("steveumuhire@gmail.com")
                ->setCc($email)
                ->setReplyTo($email)
                ->setBody(
                    $this->renderView(
                        'Email/contact.html.twig',
                        array('contact' => $contact)
                    ),
                    'text/html'
                    )
                    
                    ->addPart(
                        $this->renderView(
                            'Email/contact.txt.twig',
                            array('contact' => $contact)
                        ),
                        'text/plain'
                    );
                    
                    $mailer->send($message);
                    
                    return $this->redirectToRoute('index');
            }

        return $this->render(
            'Default/contact.html.twig',
            [
                'contactForm' => $contactForm->createView()
            ]
        );
    }

    public function acceuil(){

        return $this->render(
            'App/acceuil.html.twig'
        );
    }
    
    public function index(){

        $categories = $this->getDoctrine()->getManager()->getRepository(Category::class)->findAll();

        return $this->render(
            'Default/index.html.twig',
            [
                'categories' => $categories
            ]
        );
    }

    public function projects(){

        $categories = $this->getDoctrine()->getManager()->getRepository(Category::class)->findAll();

        return $this->render(
            'Default/projects.html.twig',
            [
                'categories' => $categories
            ]
        );
    }

     public function agency(){

        $agency = $this->getDoctrine()->getManager()->getRepository(About::class)->findOneById('7761474e-e9c6-11e9-9507-dc72a4df73a1');

        $chiffres = $this->getDoctrine()->getManager()->getRepository(Chiffre::class)->findAll();


        return $this->render(
            'Default/agency.html.twig',
            [
                'agency' => $agency,
                'chiffres' => $chiffres
            ]
        );
    }

    public function pressMenu(){

        return $this->render(
            'Press/pressMenu.html.twig'
        );
    }


    public function project(Project $project, Request $request){

        $projet = $this->getDoctrine()->getManager()->getRepository(Project::class)->findOneById($project->getId());

        return $this->render(
            'Default/project.html.twig',
            [
                'project' => $project
            ]
        );
    }

    public function jobs(){

        $jobs = $this->getDoctrine()->getManager()->getRepository(Job::class)->findAll();

        return $this->render(
            'Default/jobs.html.twig',
            [
                'jobs' => $jobs
            ]
        );
    }

    public function employee(){

        return $this->render(
            'Default/employee.html.twig'
        );
    }

     public function login(AuthenticationUtils $authUtils) {
        $error = $authUtils->getLastAuthenticationError();
        
        $lastUsername = $authUtils->getLastUsername();
        return $this->render(
            'Security/login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error' => $error,
            )
        );
    }

    public function dashboard(Request $request){
        /** 
         * Get User
         */
        $user = $this->getUser();

        if($this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')) {
        
            return $this->redirectToRoute("login");
        
        }

        /** 
         * Create & get Categories
         */

        $category = new Category();

        $categoryForm = $this->createForm(CategoryFormType::class, $category, ['standalone' => true]);

        $categoryForm->handleRequest($request);

        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) { 

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute("dashboard");
        }

        $categories = $this->getDoctrine()->getManager()->getRepository(Category::class)->findAll();

        /** 
         * Create & get projects
         */

        $project = new Project();

        $projectForm = $this->createForm(ProjectFormType::class, $project, ['standalone' => true]);

        $projectForm->handleRequest($request);

        if ($projectForm->isSubmitted() && $projectForm->isValid()) { 

            $picture = $projectForm["photo1"]->getData();
                $filename = $this->generateUniqueFileName() . "." . $picture->guessExtension();

                $path = $picture->move(
                    $this->getParameter('projects_directory'),
                    $filename
                );

                $project->setPhoto1($filename);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute("dashboard");
        }

         $projects = $this->getDoctrine()->getManager()->getRepository(Project::class)->findAll();

        /** 
         * Create & get projects
         */
        
        $employee = new Employee();

        $education = new Education();

        $employee->addEducation($education);

        $employeeForm = $this->createForm(EmployeeFormType::class, $employee, ['standalone' => true]);

        $employeeForm->handleRequest($request);

        if ($employeeForm->isSubmitted() && $employeeForm->isValid()) { 

            $picture = $employeeForm["picture"]->getData();
                $filename = $this->generateUniqueFileName() . "." . $picture->guessExtension();

                $path = $picture->move(
                    $this->getParameter('employees_directory'),
                    $filename
                );

                $employee->setPicture($filename);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($employee);
            $entityManager->flush();

            return $this->redirectToRoute("dashboard");
        }

         $employees = $this->getDoctrine()->getManager()->getRepository(Employee::class)->findAll();

        /** 
         * Create & get jobs
         */
        
        $job = new Job();

        $jobProfile = new JobProfile();

        $job->addProfil($jobProfile);

        $jobMission = new JobMission();

        $job->addMission($jobMission);


        $jobForm = $this->createForm(JobFormType::class, $job, ['standalone' => true]);

        $jobForm->handleRequest($request);

        if ($jobForm->isSubmitted() && $jobForm->isValid()) { 

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($job);
            $entityManager->flush();

            return $this->redirectToRoute("dashboard");
        }

         $jobs = $this->getDoctrine()->getManager()->getRepository(Job::class)->findAll();

        /** 
         * Get & edit about
         */

        $about = $this->getDoctrine()->getManager()->getRepository(About::class)->findOneById('7761474e-e9c6-11e9-9507-dc72a4df73a1');

         $aboutEditForm = $this->createForm(AboutFormType::class, $about, 
        [
            'standalone' => true,
        ]);

        $aboutEditForm->handleRequest($request);

        if ($aboutEditForm->isSubmitted() && $aboutEditForm->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($about);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard');

        };

        /** 
         * Get & edit chiffres clés
         */

        $chiffres = $this->getDoctrine()->getManager()->getRepository(Chiffre::class)->findAll();


        return $this->render(
        'App/dashboard.html.twig',
         
            [
                'categories' => $categories,
                'categoryForm' => $categoryForm->createView(),
                'projects' => $projects,
                'projectForm' => $projectForm->createView(),
                'employees' => $employees,
                'employeeForm' => $employeeForm->createView(),
                'jobs' => $jobs,
                'jobForm' => $jobForm->createView(),
                'about' => $about,
                'aboutEditForm' => $aboutEditForm->createView(),
                'chiffres' => $chiffres,
                
            ]
        );
    }

    public function projectEdit(Project $project, Request $request){ 

        $projectEditForm = $this->createForm(ProjectFormType::class, $project, 
        [
            'standalone' => true,
        ]);

        $projectEditForm->handleRequest($request);

        if ($projectEditForm->isSubmitted() && $projectEditForm->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard');

        };

        return $this->render(
            'App/editProject.html.twig', [
                
                'projectEditForm' => $projectEditForm->createView(),

            ]
        );

    }

    public function categoryEdit(Category $category, Request $request){ 

        $categoryEditForm = $this->createForm(CategoryEditFormType::class, $category, 
        [
            'standalone' => true,
            'category' => $category
        ]);

        $categoryEditForm->handleRequest($request);

        if ($categoryEditForm->isSubmitted() && $categoryEditForm->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard');

        };

        return $this->render(
            'App/editCategory.html.twig', [
                
                'categoryEditForm' => $categoryEditForm->createView(),

            ]
        );

    }

    public function chiffreEdit(Chiffre $chiffre, Request $request){ 

        $chiffreEditForm = $this->createForm(ChiffreFormType::class, $chiffre, 
        [
            'standalone' => true,
        ]);

        $chiffreEditForm->handleRequest($request);

        if ($chiffreEditForm->isSubmitted() && $chiffreEditForm->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chiffre);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard');

        };

        return $this->render(
            'App/editChiffre.html.twig', [
                
                'chiffreEditForm' => $chiffreEditForm->createView(),

            ]
        );

    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
}
?>