<?php
namespace App\Controller;
use App\Entity\Contact;
use App\Entity\Project;
use App\Entity\Category;
use App\Entity\Employee;
use App\Entity\Education;
use App\Form\ContactFormType;
use App\Form\ProjectFormType;
use App\Form\RunawayFormType;
use App\Form\CategoryFormType;
use App\Form\EmployeeFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class DefaultController extends AbstractController{

     public function projects(){

        return $this->render(
            'Default/projects.html.twig'
        );
    }

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

        return $this->render(
            'Default/index.html.twig'
        );
    }

     public function agency(){

        return $this->render(
            'Default/agency.html.twig'
        );
    }

    public function pressMenu(){

        return $this->render(
            'Press/pressMenu.html.twig'
        );
    }


    public function project(){

        return $this->render(
            'Default/project.html.twig'
        );
    }

    public function jobs(){

        return $this->render(
            'Default/jobs.html.twig'
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

        return $this->render(
        'App/dashboard.html.twig',
         
            [
                'categories' => $categories,
                'categoryForm' => $categoryForm->createView(),
                'projects' => $projects,
                'projectForm' => $projectForm->createView(),
                'employees' => $employees,
                'employeeForm' => $employeeForm->createView(),
                
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

        $categoryEditForm = $this->createForm(RunawayFormType::class, $category, 
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

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
}
?>