import 'package:flutter/material.dart';
import './screens/list_articles.dart';
import './screens/list_categ.dart';

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
          title: const Text('Page d''accueil'),
        ),      
        // body: const SingleChildScrollView (
        //   child: Column(
        //     children: <Widget> [
        //       ListArticles(),
        //       ListCateg()
        //     ],
        //   )
        // )  
        body: Column (
          mainAxisAlignment: MainAxisAlignment.center,
          crossAxisAlignment: CrossAxisAlignment.center,
          children: <Widget>[
            Expanded(
              child: Center(
                child: Container(
                  alignment: Alignment.center,
                  color: Colors.amber,
                  child: const ListCateg()
                ),
              )
            ),
            Expanded(
              flex: 4,
              child: Container(
                color: Colors.blue,
                child: const ListArticles()
              )
            )
          ],
        ),  
      ),
      debugShowCheckedModeBanner: false,
    );
  }
}