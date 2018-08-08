<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// namespace App\Controller;

// use App\Entity\Comment;
// use App\Entity\Post;
// use App\Events;
// use App\Form\CommentType;
// use App\Repository\PostRepository;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\EventDispatcher\EventDispatcherInterface;
// use Symfony\Component\EventDispatcher\GenericEvent;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller used to manage blog contents in the public part of the site.
 *
 * @Route("/blog")
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */

Yii::app()->defaultController = 'Blog';
Yii::app()->layout = 'base.html.twig';
Yii::app()->name = strip_tags(Yii::t('messages', 'title.homepage'));
Yii::app()->theme = 'symfony';
// Yii::app()->language = 'pl';
// Yii::app()->name = 'Symfony Blog Demo';

// echo "<pre>";
// print_r([Yii::getPathOfAlias('application.messages'),Yii::app()->sourceLanguage]);
// echo "</pre>";
// exit();
// echo "<pre>";
// print_r($post->author->fullName);
// echo "</pre>";
// exit();
// CDateFormatter->formatDateTime($timestamp,$dateWidth='medium',$timeWidth='medium')
// CLocale->getDateFormat($width='medium')
// echo "<pre>";
// print_r(Yii::app());
// echo "</pre>";
// exit();

// class BlogController extends AbstractController
class BlogController extends Controller
{
	public $layout = '//layouts/base.html.twig';
	// public $layout = '//layouts/default.ctp';
	// public $layout = 'column2';

	public function getPageTitle()
	{
		if ($this->action->id === 'index')
			return Yii::t('messages', 'title.homepage');
		else
			return Yii::t('messages', 'title.homepage') . ' - ' . ucfirst($this->action->id);
	}

	public function init()
	{
		// if (isset($this->action)) {
			$this->menu = ['item' => [
				['label' => Yii::t('messages', 'menu.back_to_blog'), 'url' => 'symfony/blog/index'],
			// ['label' => Yii::t('messages', 'menu.post_list'), 'url' => 'symfony/admin/blog/index']
			]];

			$this->breadcrumbs = [
				Yii::t('messages', 'menu.back_to_blog') => '/symfony/blog/index',
				// Yii::t('messages', 'menu.post_list') => '/symfony/admin/blog/index',
			];
		// }
	}

	/**
	 * @Route("/", defaults={"page": "1", "_format"="html"}, methods={"GET"}, name="blog_index")
	 * @Route("/rss.xml", defaults={"page": "1", "_format"="xml"}, methods={"GET"}, name="blog_rss")
	 * @Route("/page/{page<[1-9]\d*>}", defaults={"_format"="html"}, methods={"GET"}, name="blog_index_paginated")
	 * @Cache(smaxage="10")
	 *
	 * NOTE: For standard formats, Symfony will also automatically choose the best
	 * Content-Type header for the response.
	 * See https://symfony.com/doc/current/quick_tour/the_controller.html#using-formats
	 */
	// public function index(int $page, string $_format, PostRepository $posts): Response
	// {
	// 	$latestPosts = $posts->findLatest($page);

	// 	// Every template name also has two extensions that specify the format and
	// 	// engine for that template.
	// 	// See https://symfony.com/doc/current/templating.html#template-suffix
	// 	return $this->render('blog/index.'.$_format.'.twig', ['posts' => $latestPosts]);
	// }

	public function actionIndex($page = 1, $_format = 'html', $posts = 'DemoPost')
	{
		if($_format == 'xml') $this->layout = ' ';

		$criteria = new CDbCriteria([
			// 'condition' => 'status=' . DemoPost::STATUS_PUBLISHED,
			'order' => 'publishedAt DESC',
			'with' => 'commentCount',
		]);

		$count = DemoPost::model()->count($criteria);
		$pages = new CPagination($count);

		## results per page
		$pages->pageSize = 5;//$this->paginate['limit'];Yii::app()->params['postsPerPage'],
		$pages->applyLimit($criteria);

		$latestPosts = DemoPost::model()->findAll($criteria);
		// $latestPosts = new CActiveDataProvider('DemoPost', [
		// 	'pagination' => [
		// 		'pageSize' => 3,//Yii::app()->params['postsPerPage'],
		// 	],
		// 	'criteria' => $criteria,
		// ]);
		// $this->render('//blog/index.' . $_format . '.twig', ['posts' => $latestPosts->getData()]);

		$this->render('//blog/index.' . $_format . '.twig', [
			'posts' => $latestPosts, //$latestPosts->getData(),//
			'pages' => $pages
		]);
	}
	// public function actionBlogIndex($page = 1, $_format = 'html', $posts = 'DemoPost')
	// {
	// 	return $this->actionIndex($page, $_format, $posts);
	// }
	public function actionRss($page = 1, $_format = 'xml', $posts = 'DemoPost')
	{
		return $this->actionIndex($page, $_format, $posts);
	}

	/**
	 * @Route("/posts/{slug}", methods={"GET"}, name="blog_post")
	 *
	 * NOTE: The $post controller argument is automatically injected by Symfony
	 * after performing a database query looking for a Post with the 'slug'
	 * value given in the route.
	 * See https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html
	 */
	// public function show(Post $post): Response 
	// {
	// 	// Symfony's 'dump()' function is an improved version of PHP's 'var_dump()' but
	// 	// it's not available in the 'prod' environment to prevent leaking sensitive information.
	// 	// It can be used both in PHP files and Twig templates, but it requires to
	// 	// have enabled the DebugBundle. Uncomment the following line to see it in action:
	// 	//
	// 	// dump($post, $this->getUser(), new \DateTime());

	// 	return $this->render('blog/post_show.html.twig', ['post' => $post]);
	// }
	public function actionShow($slug)//$slug
	{
		// $slug = $_GET['slug'];
		if (isset($slug)) {
			$post = DemoPost::model()->with(['comments', 'symfonyDemoTags'])->findByAttributes(['slug' => $slug]);
		}
		$this->render('//blog/post_show.html.twig', ['post' => $post]);
	}

	/**
	 * @Route("/comment/{postSlug}/new", methods={"POST"}, name="comment_new")
	 * @IsGranted("IS_AUTHENTICATED_FULLY")
	 * @ParamConverter("post", options={"mapping": {"postSlug": "slug"}})
	 *
	 * NOTE: The ParamConverter mapping is required because the route parameter
	 * (postSlug) doesn't match any of the Doctrine entity properties (slug).
	 * See https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html#doctrine-converter
	 */
	public function commentNew(Request $request, Post $post, EventDispatcherInterface $eventDispatcher): Response
	{
		$comment = new Comment();
		$comment->setAuthor($this->getUser());
		$post->addComment($comment);

		$form = $this->createForm(CommentType::class, $comment);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($comment);
			$em->flush();

			// When triggering an event, you can optionally pass some information.
			// For simple applications, use the GenericEvent object provided by Symfony
			// to pass some PHP variables. For more complex applications, define your
			// own event object classes.
			// See https://symfony.com/doc/current/components/event_dispatcher/generic_event.html
			$event = new GenericEvent($comment);

			// When an event is dispatched, Symfony notifies it to all the listeners
			// and subscribers registered to it. Listeners can modify the information
			// passed in the event and they can even modify the execution flow, so
			// there's no guarantee that the rest of this controller will be executed.
			// See https://symfony.com/doc/current/components/event_dispatcher.html
			$eventDispatcher->dispatch(Events::COMMENT_CREATED, $event);

			return $this->redirectToRoute('blog_post', ['slug' => $post->getSlug()]);
		}

		return $this->render('blog/comment_form_error.html.twig', [
			'post' => $post,
			'form' => $form->createView(),
		]);
	}

	/**
	 * This controller is called directly via the render() function in the
	 * blog/post_show.html.twig template. That's why it's not needed to define
	 * a route name for it.
	 *
	 * The "id" of the Post is passed in and then turned into a Post object
	 * automatically by the ParamConverter.
	 */
	// public function commentForm(Post $post): Response
	// {
	// 	$form = $this->createForm(CommentType::class);

	// 	return $this->render('blog/_comment_form.html.twig', [
	// 		'post' => $post,
	// 		'form' => $form->createView(),
	// 	]);
	// }
	public function actionCommentForm()
	{
		$this->renderText('<a href="javascript:history.back();">-:[BACK]:-</a>');
	}	/**
	 * @Route("/search", methods={"GET"}, name="blog_search")
	 */
	// public function search(Request $request, PostRepository $posts): Response
	// {
	// 	if (!$request->isXmlHttpRequest()) {
	// 		return $this->render('blog/search.html.twig');
	// 	}

	// 	$query = $request->query->get('q', '');
	// 	$limit = $request->query->get('l', 10);
	// 	$foundPosts = $posts->findBySearchQuery($query, $limit);

	// 	$results = [];
	// 	foreach ($foundPosts as $post) {
	// 		$results[] = [
	// 			'title' => htmlspecialchars($post->getTitle(), ENT_COMPAT | ENT_HTML5),
	// 			'date' => $post->getPublishedAt()->format('M d, Y'),
	// 			'author' => htmlspecialchars($post->getAuthor()->getFullName(), ENT_COMPAT | ENT_HTML5),
	// 			'summary' => htmlspecialchars($post->getSummary(), ENT_COMPAT | ENT_HTML5),
	// 			'url' => $this->generateUrl('blog_post', ['slug' => $post->getSlug()]),
	// 		];
	// 	}

	// 	return $this->json($results);
	// }
	public function actionSearch()
	{
		$this->render('//blog/search.html.twig');
	}

	/**
	 * Takes the list of codes of the locales (languages) enabled in the
	 * application and returns an array with the name of each locale written
	 * in its own language (e.g. English, Français, Español, etc.).
	 */
	// public function getLocales(): array
	// {
	// 	if (null !== $this->locales) {
	// 		return $this->locales;
	// 	}

	// 	$this->locales = [];
	// 	foreach ($this->localeCodes as $localeCode) {
	// 		$this->locales[] = ['code' => $localeCode, 'name' => Intl::getLocaleBundle()->getLocaleName($localeCode, $localeCode)];
	// 	}

	// 	return $this->locales;
	// }
}