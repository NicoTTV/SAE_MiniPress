import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import './screens/list_articles.dart';
import './screens/list_categ.dart';
import './screens/form_keyWord_sort.dart';
import 'models/article_provider.dart';

class MiniPressApp extends StatefulWidget {
  const MiniPressApp({super.key});

  @override
  State<MiniPressApp> createState() => _MiniPressAppState();
}

class _MiniPressAppState extends State<MiniPressApp> {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Mini Press',
      home: Scaffold(
        appBar: AppBar(
          title: const Text('Page d\'accueil'),
        ),
        body: Column(
          children: <Widget>[
            const Expanded(child: ListCateg()),
            const Expanded(child: ListArticles(),flex: 10),
            Expanded(
                child: Container(
              decoration: const BoxDecoration(
                color: Color(0xFFE9F1FA),
                boxShadow: [
                  BoxShadow(
                      color: Color.fromARGB(40, 0, 0, 0),
                      spreadRadius: 1,
                      blurRadius: 10)
                ],
              ),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  const FormKeyWordSort(),
                  ElevatedButton(
                      onPressed: () {
                        Provider.of<ArticleProvider>(context, listen: false)
                            .fetchArticleByDate();
                      },
                      child: const Text('Trier par date de création'))
                ],
              ),
            )),
          ],
        ),
      ),
      debugShowCheckedModeBanner: false,
    );
  }
}
